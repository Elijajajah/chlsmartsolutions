<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use Livewire\Component;

class DashboardOverview extends Component
{
    public $startDate;

    public function mount($date)
    {
        $this->startDate = $date;
    }

    public function getTotalExpensesProperty()
    {
        return Expense::whereBetween('expense_date', [$this->startDate, now()])->sum('amount');
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

    public function getOrderProperty()
    {
        return Order::where('status', 'pending')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->count();
    }

    public function getStaffProperty()
    {
        return User::whereNotIn('role', ['customer', 'owner'])
            ->where('status', 'active')
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard-overview');
    }
}
