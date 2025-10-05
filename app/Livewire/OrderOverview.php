<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderOverview extends Component
{
    public $active = '';
    public $take = 2;

    public function mount($take = 2)
    {
        $this->take = $take;
    }

    public function setActive($option)
    {
        $this->active = $option;
        session()->put('sidebar_active', $option);
        $this->dispatch('activate', $option)->to('sidebar');
    }

    public function render()
    {
        $order = Order::whereDate('created_at', '<=', now())
            ->whereDate('expiry_date', '>=', now())
            ->where('status', 'pending')
            ->take($this->take)
            ->get();

        return view('livewire.order-overview', [
            'orders' => $order,
        ]);
    }
}
