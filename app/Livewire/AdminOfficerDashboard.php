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

    public function getTaskProperty()
    {
        return Task::where('status', 'pending')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->count();
    }

    public function getOrderProperty()
    {
        return Order::where('status', 'pending')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->count();
    }

    public function getTotalSalesProperty()
    {
        // Orders total
        $ordersTotal = Order::whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->sum('total_amount');

        // Tasks total
        $tasksTotal = Task::whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->sum('price');

        return $ordersTotal + $tasksTotal;
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
