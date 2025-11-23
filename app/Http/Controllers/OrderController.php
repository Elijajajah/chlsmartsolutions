<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductSerial;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

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
            'type' => 'required',
            'customer_name' => 'nullable',
            'tax' => 'nullable',
            'payment_method' => 'nullable'
        ], [
            'total_amount.required' => 'Total Amount is required',
            'type.required' => 'Please select a customer type.'
        ]);

        $tax = is_numeric($request->tax) ? $request->tax : 0;
        $payment_method = $request->payment_method !== null ? $request->payment_method : 'none';
        $customer_name = trim($request->customer_name ?? '') ?: Auth::user()->fullname;
        $cartItems = session()->get('cartItems', []);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            notyf()->error($message);
            return redirect()->back();
        }

        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            $availableSerialsCount = ProductSerial::where('product_id', $product->id)
                ->where('status', 'available')
                ->count();

            if ($availableSerialsCount < count($item->serials)) {
                notyf()->error("{$item->name} is out of stock.");
                return redirect()->route('landing.page');
            }
        }

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'customer_name' => $customer_name,
            'total_amount' => $request->total_amount * (1 + $tax / 100),
            'type' => $request->type,
            'tax' => $tax,
            'payment_method' => $payment_method,
        ]);

        $referenceId = $this->generateReferenceId(
            $request->type,
            now()->format('mdY'),
            $order->id
        );
        $order->update(['reference_id' => $referenceId]);

        foreach ($cartItems as $item) {
            $serialNumbers = is_array($item->serials) ? $item->serials : [];

            // Get serials from DB by serial number
            $serials = ProductSerial::whereIn('serial_number', $serialNumbers)
                ->where('product_id', $item->id)
                ->get();

            // Attach to order
            $order->productSerials()->attach($serials->pluck('id')->toArray());
        }

        session()->forget('cartItems');

        notyf()->success('Order placed successfully');

        if ($request->type === 'online') {
            Mail::to(Auth::user()->email)->send(
                new OrderConfirmationMail($order, $cartItems)
            );

            app(NotificationService::class)->createNotif(
                "New Order Requested",
                $order->customer_name . " has requested a new order.",
                ['owner', 'cashier', 'admin_officer'],
            );
        }

        session([
            'showCard' => true,
            'orderId' => $order->id,
            'total' => $order->total_amount,
            'referenceId' => $order->reference_id,
        ]);
        return redirect()->route('landing.page');
    }
}
