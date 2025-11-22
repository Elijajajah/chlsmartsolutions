<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OrderService;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReservedMail;
use App\Mail\OrderCanceledMail;
use App\Mail\OrderCompletedMail;

class OrderBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 0;
    public $selectedType = '', $selectedDate = 'today';
    public $search = '';
    public $selectedOrder = null;
    public $showModal = false;
    public $type = null, $customer_name = '';
    public string $activeTab = 'orderBrowse';

    public function selectOrder($order_id)
    {
        $this->showModal = true;
        $this->selectedOrder = Order::with('productSerials.product')->find($order_id);
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
                // Mark serials as sold
                $order->productSerials()->update(['status' => 'sold']);
                // Mark order as completed
                $order->status = 'completed';
                $order->updated_at = now();
                $order->save();

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderCompletedMail($order));
                }

                app(NotificationService::class)->createNotif(
                    Auth::user()->id,
                    'Order Completed',
                    "{$order->reference_id} placed by {$order->user->fullname} has been successfully completed.",
                    ['owner', 'cashier', 'admin_officer'],
                );

                notyf()->success('Order has been completed.');
                break;

            case 'reserved':
                // Mark serials as reserved, order stays pending
                $order->productSerials()->update(['status' => 'reserved']);
                $order->status = 'reserved';
                $order->updated_at = now();
                $order->save();

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderReservedMail($order));
                }

                notyf()->success('Products have been reserved, order remains pending.');
                break;

            case 'cancel':
                // Revert serials to available
                $order->productSerials()->update(['status' => 'available']);
                $order->status = 'canceled';
                $order->updated_at = now();
                $order->save();

                if ($order->user->role === 'customer') {
                    Mail::to($order->user->email)->send(new OrderCanceledMail($order));
                }

                app(NotificationService::class)->createNotif(
                    Auth::user()->id,
                    'Order Canceled',
                    "{$order->reference_id} placed by {$order->user->fullname} has been canceled.",
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
