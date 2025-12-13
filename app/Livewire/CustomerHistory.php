<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerHistory extends Component
{
    public $selectedDate = 'this_week';

    public function render()
    {
        $orders = Order::with('productSerials.product')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['completed', 'reserved'])
            ->when($this->selectedDate, function ($query) {
                match ($this->selectedDate) {
                    'today' => $query->whereDate('created_at', Carbon::today()),

                    'this_week' => $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek(),
                    ]),

                    'this_month' => $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year),

                    'this_year' => $query->whereYear('created_at', Carbon::now()->year),

                    default => null,
                };
            })
            ->latest()
            ->get();

        return view('livewire.customer-history', compact('orders'));
    }
}
