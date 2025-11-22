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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class OrderBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 0;
    public $selectedType = '', $selectedDate = 'today';
    public $search = '';
    public $selectedOrder = null;
    public $showModal = false;
    public $type = null, $customer_name = '', $payment_method = 'none';
    public string $activeTab = 'orderBrowse';

    public function selectOrder($order_id)
    {
        $this->showModal = true;
        $this->selectedOrder = Order::with('productSerials.product')->find($order_id);
        $this->payment_method = $this->selectedOrder->payment_method;
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

    public function updateStatus($id, $status)
    {
        // Validate payment method only if the order is being completed or reserved
        if (in_array($status, ['sold', 'reserved'])) {
            try {
                $this->validate([
                    'payment_method' => 'required',
                ], [
                    'payment_method.required' => 'Payment Method is required.',
                ]);
            } catch (ValidationException $e) {
                $message = $e->validator->errors()->first();
                notyf()->error($message);
                return;
            }
        }

        $order = Order::with('productSerials')->findOrFail($id);

        if ($order->status === 'completed') {
            notyf()->error('Order has already been completed.');
            return;
        }

        if ($order->status !== 'pending') {
            notyf()->error('Order has expired.');
            return;
        }

        switch ($status) {
            case 'sold':
                $order->productSerials()->update(['status' => 'sold']);
                $order->update([
                    'status' => 'completed',
                    'payment_method' => $this->payment_method
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
                break;

            case 'reserved':
                $order->productSerials()->update(['status' => 'reserved']);
                $order->update([
                    'status' => 'reserved',
                    'payment_method' => $this->payment_method
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
                break;

            case 'cancel':
                $order->productSerials()->update(['status' => 'available']);
                $order->update(['status' => 'canceled']);

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

    public function goToCheckout()
    {
        if (empty(session('cartItems'))) {
            notyf()->error('Your product list is empty.');
            return;
        }

        if (!trim($this->customer_name ?? '')) {
            notyf()->error('Please select a customer name.');
            return;
        }

        if (!$this->type) {
            notyf()->error('Please select a customer type.');
            return;
        }

        $total = 0.0;
        $products = session()->get('cartItems', []);
        foreach ($products as $product) {
            $total += $product->quantity * $product->price;
        }

        $this->dispatch('submit-form', [
            'total_amount' => $total,
            'payment_method' => 'in_store',
        ]);
    }
}
