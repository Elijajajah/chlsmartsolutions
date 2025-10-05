<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OrderService;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class OrderBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 0;
    public $search = '';
    public $selectedOrder = null;
    public $showModal = false;
    public $type = null;
    public string $activeTab = 'orderBrowse';

    public function selectOrder($order_id)
    {
        $this->showModal = true;
        $this->selectedOrder = Order::with('orderProducts.product')->find($order_id);
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
        $orders = $orderService->getFilteredOrders($this->selectedStatus, $this->search);
        return view('livewire.order-browser',[
            'orders' => $orders
        ]);
    }

    public function getOrder($status = null)
    {
        $orderService = app(OrderService::class);
        return $orderService->countOrder($status);
    }

    public function updateStatus($id)
    {
        $order = Order::find($id);
        if ($order->status == 'pending'){
            $order->status = 'completed';
            $order->updated_at = now();
            $order->save();

            app(NotificationService::class)->createNotif(
                Auth::user()->id,
                'Order Completed',
                "{$order->reference_id} placed by {$order->user->fullname} has been successfully completed.",
                ['admin', 'cashier', 'admin_officer'],
            );

            notyf()->success('Order has been completed.');
            $this->dispatch('notificationRead')->to('sidebar');
            $this->closeModal();
            return;
        }elseif ($order->status == 'completed') {
            notyf()->error('Order already been completed.');
            return;
        }

        notyf()->error('Order has expired.');
    }

    public function goToCheckout()
    {
        if (empty(session('cartItems'))) {
            notyf()->error('Your product list is empty.');
            return;
        }

        if (!$this->type) {
            notyf()->error('Please select a customer type.');
            return;
        }

        $total = 0.0;
        $products = session()->get('cartItems', []);
        foreach ($products as $product){
            $total += $product->quantity * $product->price;
        }

        $this->dispatch('submit-form', [
            'total_amount' => $total,
            'payment_method' => 'in_store',
        ]);
    }
}
