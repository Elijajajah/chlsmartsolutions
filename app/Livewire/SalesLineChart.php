<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SalesLineChart extends Component
{
    public $chartData;
    public $startDate;

    public function mount($date)
    {
        $this->startDate = $date;
        $this->chartData = $this->getChartData();
    }

    public function getChartData()
    {
        $orders = Order::selectRaw('type, DATE(created_at) as date, SUM(total_amount) as total_amount')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->groupBy('type', DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $typeLabels = [
            'walk_in' => 'Walk-In',
            'online' => 'Online',
            'government' => 'Government',
            'project_based' => 'Project-Based',
        ];

        $groupedOrders = $orders->groupBy('type');

        $series = [];

        foreach ($groupedOrders as $type => $typeOrders) {
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


    public function render()
    {
        return view('livewire.sales-line-chart');
    }
}
