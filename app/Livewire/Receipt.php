<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\DownPayment;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Receipt extends Component
{
    #[On('save-receipt')]
    public function saveReceipt($image)
    {
        if (session('receipt_saved')) return;

        if (! session()->has('receipt_type')) {
            session(['receipt_type' => 'order']);
        }

        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = base64_decode($image);

        $path = 'receipts/' . Str::uuid() . '.png';

        Storage::disk('public')->put($path, $image);

        $type = session('receipt_type', 'order');

        if (session('receipt_type') === 'downpayment' && session()->has('down_payment_id')) {

            $downPayment = DownPayment::findOrFail(
                session('down_payment_id')
            );

            $downPayment->update([
                'path' => $path,
            ]);
        } else {
            // ✅ Default always goes here
            $order->update([
                'path' => $path,
            ]);
        }

        session([
            'receipt_saved' => true
        ]);

        $this->dispatch('receipt-saved');
    }

    public function downloadReceipt(): StreamedResponse
    {
        $orderId = session('orderId');

        $order = Order::findOrFail($orderId);

        if (! $order->path || ! Storage::disk('public')->exists($order->path)) {
            abort(404, 'Receipt not found');
        }

        return Storage::disk('public')->download(
            $order->path,
            'receipt_' . $order->reference_id . '.png'
        );
    }

    public function clearSession()
    {
        session()->forget([
            'showCard',
            'orderId',
            'referenceId',
            'receipt_saved',
            'receipt_type',
            'down_payment_id',
        ]);
    }

    public function render()
    {
        return view('livewire.receipt');
    }
}
