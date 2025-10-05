<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use Livewire\Component;

class AdminOfficerDashboard extends Component
{
    public $selectedDate = 'this_year';
    public $startDate;

    public function mount()
    {
        $this->startDate = now()->startOfYear()->toDateString();
    }

    public function updatedSelectedDate($value)
    {
        match ($value) {
            'today' => $this->startDate = now()->toDateString(),
            'this_week' => $this->startDate = now()->startOfWeek()->toDateString(),
            'this_month' => $this->startDate = now()->startOfMonth()->toDateString(),
            'this_year' => $this->startDate = now()->startOfYear()->toDateString(),
            default => null,
        };
    }
    public function getTotalProductProperty()
    {
        return Product::count();
    }

    public function getTaskTodayProperty()
    {
        return Task::whereDate('created_at', '<=', now())
            ->whereDate('expiry_date', '>=', now())
            ->where('status', 'pending')
            ->count();
    }

    public function getOrderTodayProperty()
    {
        return Order::whereDate('created_at', '<=', now())
            ->whereDate('expiry_date', '>=', now())
            ->where('status', 'pending')
            ->count();
    }

    public function getSalesTodayProperty()
    {
        return Order::whereDate('updated_at', now())
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    public function getTotalExpensesProperty()
    {
        return Expense::whereBetween('expense_date', [$this->startDate, now()])->sum('amount');
    }

    public function render()
    {
        return view('livewire.admin-officer-dashboard');
    }
}
