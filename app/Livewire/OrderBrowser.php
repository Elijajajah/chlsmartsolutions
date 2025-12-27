<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OrderService;
use App\Mail\OrderCanceledMail;
use App\Mail\OrderReservedMail;
use App\Mail\OrderCompletedMail;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Mail;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;

class OrderBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 0;
    public $selectedType = '', $selectedDate = 'today';
    public $search = '';
    public $selectedOrder = null;
    public $showModal = false;
    public $payment_method = 'none', $type = '', $tax = '', $total_amount = '', $price = '';
    public string $activeTab = 'orderBrowse';
    public bool $typeInitialized = false;
    public bool $showReserveInput = false;
    public $reserve_amount = null;

    public function selectOrder($order_id)
    {
        $this->showModal = true;
        $this->selectedOrder = Order::with('productSerials.product', 'receipt')->find($order_id);
        $this->payment_method = $this->selectedOrder->payment_method;
        $this->type = $this->selectedOrder->type;
        $this->tax = $this->selectedOrder->tax;
        $this->price = $this->selectedOrder->total_amount;
        $this->total_amount = $this->selectedOrder->total_amount;
    }

    public function updatedTax()
    {
        $price = floatval($this->price ?: 0);
        $tax   = floatval($this->tax ?: 0);

        $this->total_amount = $price * (1 + $tax / 100);
    }

    public function updatedType($value)
    {
        if ($this->typeInitialized) {
            $this->tax = '';
            $this->total_amount = $this->price;
        }

        $this->typeInitialized = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function updated($property)
    {
        if ($property === 'selectedStatus' || $property === 'search') {
            $this->gotoPage(1);
        }
    }

    public function render(OrderService $orderService)
    {
        $orders = $orderService->getFilteredOrders($this->selectedStatus, $this->search, $this->selectedType, $this->selectedDate);
        return view('livewire.order-browser', [
            'orders' => $orders
        ]);
    }

    public function getOrder($status = null)
    {
        $orderService = app(OrderService::class);
        return $orderService->countOrder($status);
    }

    public function prepareReserve()
    {
        $this->showReserveInput = true;
    }

    public function confirmReserve($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status === 'reserved') {
            notyf()->error('This order is already reserved.');
            return;
        }

        $this->validate([
            'reserve_amount' => 'required|numeric|min:1',
        ], [
            'reserve_amount.required' => 'Please enter a reserve amount.',
            'reserve_amount.min' => 'Reserve amount must be greater than zero.',
        ]);

        $this->updateStatus($orderId, 'reserved');
    }


    public function downloadOrder(int $orderId): StreamedResponse
    {
        $order = Order::findOrFail($orderId);

        if (! $order->path) {
            notyf()->error('Receipt not found for this order.');
            abort(404);
        }

        if (! Storage::disk('public')->exists($order->path)) {
            notyf()->error('Receipt file is missing.');
            abort(404);
        }

        return Storage::disk('public')->download(
            $order->path,
            'receipt_' . $order->reference_id . '.png'
        );
    }

    public function updateStatus($id, $status)
    {
        if (in_array($status, ['sold', 'reserved'])) {
            try {
                $this->validate([
                    'payment_method' => 'required|not_in:none',
                    'type' => 'required',
                    'tax' => 'required_if:type,government|numeric|min:0',
                ], [
                    'payment_method.required' => 'Payment Method is required.',
                    'payment_method.not_in' => 'Please select a valid payment method.',
                    'type.required' => 'Customer Type is required.',
                    'tax.required_if' => 'Tax is required for government customers.',
                    'tax.min' => 'Tax cannot be less than 0.',
                ]);
            } catch (ValidationException $e) {
                $message = $e->validator->errors()->first();
                notyf()->error($message);
                return;
            }
        }

        $order = Order::with('productSerials.product')->findOrFail($id);

        foreach ($order->productSerials as $serial) {
            if ($serial->status === 'sold' || $serial->status === 'reserved') {
                $product = $serial->product;

                $replacement = $product->serials()
                    ->where('status', 'available')
                    ->whereNotIn('id', $order->productSerials->pluck('id'))
                    ->first();

                if ($replacement) {
                    $order->productSerials()->detach($serial->id);
                    $order->productSerials()->attach($replacement->id);
                } else {
                    notyf()->error("Product {$product->name} has no available item to replace.");
                    return;
                }
            }
        }

        if ($order->status === 'completed') {
            notyf()->error('Order has already been completed.');
            return;
        }

        if ($order->status === 'canceled') {
            notyf()->error('Only has already been canceled.');
            return;
        }

        switch ($status) {
            case 'sold':
                $remaining = $order->remainingBalance();

                if ($remaining > 0) {
                    $downPayment = $order->downPayments()->create([
                        'amount' => $remaining,
                    ]);
                }

                $order->productSerials()->update(['status' => 'sold']);
                $order->update([
                    'status' => 'completed',
                    'payment_method' => $this->payment_method,
                    'total_amount' => $this->total_amount,
                    'type' => $this->type,
                    'tax' => $this->tax,
                ]);

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderCompletedMail($order));
                }

                app(NotificationService::class)->createNotif(
                    'Order Completed',
                    "{$order->reference_id} placed by {$order->customer_name} has been successfully completed.",
                    ['owner', 'cashier', 'admin_officer'],
                );

                notyf()->success('Order has been completed.');

                session([
                    'showCard' => true,
                    'orderId' => $order->id,
                    'total' => $order->total_amount,
                    'tax' => $order->tax,
                    'referenceId' => $order->reference_id,
                    'down_payment_id' => $downPayment->id,
                    'receipt_type' => 'downpayment',
                ]);
                $this->dispatch('refresh-page');
                break;

            case 'reserved':

                if (!$this->reserve_amount || $this->reserve_amount <= 0) {
                    notyf()->error('Reserve amount is required.');
                    return;
                }

                if ($this->reserve_amount > $order->remainingBalance()) {
                    notyf()->error('Reserve amount exceeds remaining balance.');
                    return;
                }

                $downPayment = $order->downPayments()->create([
                    'amount' => $this->reserve_amount,
                ]);

                $order->productSerials()->update(['status' => 'reserved']);
                $order->update([
                    'status' => 'reserved',
                    'payment_method' => $this->payment_method,
                    'total_amount' => $this->total_amount,
                    'type' => $this->type,
                    'tax' => $this->tax,
                ]);

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderReservedMail($order));
                }

                app(NotificationService::class)->createNotif(
                    'Order Reserved',
                    "{$order->reference_id} placed by {$order->customer_name} has been reserved.",
                    ['owner', 'cashier', 'admin_officer'],
                );

                notyf()->success('Products have been reserved, order remains pending.');

                session([
                    'showCard' => true,
                    'orderId' => $order->id,
                    'total' => $order->total_amount,
                    'tax' => $order->tax,
                    'referenceId' => $order->reference_id,
                    'down_payment_id' => $downPayment->id,
                    'receipt_type' => 'downpayment',
                ]);
                $this->dispatch('refresh-page');
                break;

            case 'cancel':
                $order->productSerials()->update(['status' => 'available']);
                $order->update([
                    'status' => 'canceled'
                ]);

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderCanceledMail($order));
                }

                app(NotificationService::class)->createNotif(
                    'Order Canceled',
                    "{$order->reference_id} placed by {$order->customer_name} has been canceled.",
                    ['owner', 'cashier', 'admin_officer'],
                );

                notyf()->success('Order has been canceled and products are now available.');
                break;

            default:
                notyf()->error('Invalid status.');
                return;
        }

        $this->dispatch('notificationRead')->to('sidebar');
        $this->closeModal();
    }
}
