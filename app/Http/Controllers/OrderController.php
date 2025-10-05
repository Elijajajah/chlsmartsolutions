<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\OrderInventory;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;

class OrderController
{
    private function generateReferenceId($type, $date, $id = 0)
    {
        $prefix = match ($type) {
            'online' => 'OL',
            'walk_in' => 'WI',
            'government' => 'GV',
            'project_based' => 'PB',
            default => 'XX',
        };

        return $prefix . '-' . $date . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_amount' => 'required',
            'payment_method' => 'required',
            'type' => 'required',
            'status' => 'nullable'
        ], [
            'total_amount.required' => 'Total Amount is required',
            'payment_method.required' => 'Please select payment type.',
            'type.required' => 'Please select a customer type.'
        ]);

        $cartItems = session()->get('cartItems', []);

        if ($validator->fails()){
            $message = $validator->errors()->first();
            notyf()->error($message);
            return redirect()->back();
        }

        if ($request->payment_method == 'e-wallet'){
            return; //for now
        }

        foreach($cartItems as $item){
            $product = Product::with('inventory')->where('id', $item->id)->first();
            if ($product->inventory->stock < $item->quantity){
                $cartItems = array_filter($cartItems, function ($item) {
                    return $item->id !== $item->id;
                });
                session()->put('cartItems', $cartItems);
                notyf()->error("{$item->name} out of stock");
                return redirect()->route('landing.page');
            }
        }

        $expiry = now()->addDays(3)->toDateString();
        $status = 'pending';
        if ($request->type != 'online'){
            $expiry = now();
            $status = 'completed';
        }

        $order = Order::create([
            'reference_id' => $this->generateReferenceId($request->type, now()->format('mdY'), Auth::user()->id),
            'user_id' => Auth::user()->id,
            'total_amount' => $request->total_amount,
            'type' => $request->type,
            'status' => $status,
            'expiry_date' => $expiry,
        ]);

        foreach($cartItems as $item){
            OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => $item->id,
            'quantity' => $item->quantity,
            ]);
        }

        foreach($cartItems as $item){
            $product = Inventory::where('product_id', $item->id)->first();
            $product->stock -= $item->quantity;
            $product->save();
        }

        session()->forget('cartItems');

        if ($order->status == 'completed') {
            $selectedOrder = Order::with('user')->find($order->id);
            app(NotificationService::class)->createNotif(
                    $selectedOrder->user_id,
                    "Order Completed",
                    "{$selectedOrder->reference_id} placed by {$selectedOrder->user->fullname} has been successfully completed.",
                    ['admin', 'cashier', 'admin_officer'],
                );
        }

        notyf()->success('Order placed successfully');
        session([
            'showCard' => true,
            'orderId' => $order->id,
            'total' => $order->total_amount,
            'referenceId' => $order->reference_id,
        ]);
        return redirect()->route('landing.page');
    }
}
