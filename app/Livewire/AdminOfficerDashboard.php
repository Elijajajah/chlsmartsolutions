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
            ->where('status', 'pending')
            ->count();
    }

    public function getOrderTodayProperty()
    {
        return Order::whereDate('created_at', '<=', now())
            ->where('status', 'pending')
            ->count();
    }

    public function getTotalSalesProperty()
    {
        return Order::where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->sum('total_amount');
    }

    public function getTotalExpensesProperty()
    {
        return Expense::whereBetween('expense_date', [$this->startDate, now()])->sum('amount');
    }

    public function exportAll()
    {
        return redirect()->to(route('export.all', ['startDate' => $this->startDate]));
    }

    public function render()
    {
        return view('livewire.admin-officer-dashboard');
    }
}
