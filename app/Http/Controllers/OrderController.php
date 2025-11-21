<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductSerial;
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
            'type' => 'required',
            'status' => 'nullable'
        ], [
            'total_amount.required' => 'Total Amount is required',
            'type.required' => 'Please select a customer type.'
        ]);

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

        $expiry = now()->addDays(1)->toDateString();
        $status = 'pending';

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'customer_name' => $customer_name,
            'total_amount' => $request->total_amount,
            'type' => $request->type,
            'status' => $status,
            'expiry_date' => $expiry,
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
            // Mark serials as reserved
            ProductSerial::whereIn('id', $serials->pluck('id'))
                ->update(['status' => 'reserved']);
        }

        session()->forget('cartItems');

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
