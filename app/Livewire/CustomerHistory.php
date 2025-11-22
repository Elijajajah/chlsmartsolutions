<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CustomerHistory extends Component
{
    public function render()
    {
        $orders = Order::with('productSerials.product')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();
        return view('livewire.customer-history', compact('orders'));
    }
}
