<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Receipt extends Component
{
    #[On('save-receipt')]
    public function saveReceipt($image)
    {
        if (session('receipt_saved')) return;

        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = base64_decode($image);

        $path = 'receipts/' . Str::uuid() . '.png';

        Storage::disk('public')->put($path, $image);

        $order->update([
            'path' => $path
        ]);

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
            'total',
            'referenceId',
            'receipt_saved'
        ]);
    }

    public function render()
    {
        return view('livewire.receipt');
    }
}
