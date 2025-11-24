<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class CashierDashboard extends Component
{
    public $chartData;
    public $selectedDate = 'this_year';
    public $startDate;

    public function mount()
    {
        $this->startDate = now()->startOfYear()->toDateString();
        $this->chartData = $this->getChartData();
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

    public function getChartData()
    {
        $orders = Order::selectRaw('type, total_amount, DATE(created_at) as date')
            ->where('status', 'completed')
            ->orderBy('created_at')
            ->get()
            ->groupBy('type');

        $typeLabels = [
            'walk_in' => 'Walk-In',
            'online' => 'Online',
            'government' => 'Government',
            'project_based' => 'Project-Based',
        ];

        $series = [];

        foreach ($orders as $type => $typeOrders) {
            $data = $typeOrders->map(fn($order) => [
                'x' => Carbon::parse($order->date)->format('Y-m-d'),
                'y' => (float) $order->total_amount
            ])->values()->all();

            $series[] = [
                'name' => $typeLabels[$type] ?? ucfirst($type),
                'data' => $data
            ];
        }

        return $series;
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

    public function getSalesTodayProperty()
    {
        return Order::whereDate('updated_at', now())
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    public function getTotalRevenueProperty()
    {
        return Order::where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->sum('total_amount');
    }

    public function render()
    {

        return view('livewire.cashier-dashboard');
    }
}
