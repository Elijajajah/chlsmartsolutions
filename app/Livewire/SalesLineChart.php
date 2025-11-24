<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Task;
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
        $typeLabels = [
            'walk_in' => 'Walk-In',
            'online' => 'Online',
            'government' => 'Government',
            'project_based' => 'Project-Based',
        ];

        // Fetch Orders
        $orders = Order::selectRaw('type, DATE(updated_at) as date, SUM(total_amount) as total')
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->groupBy('type', DB::raw('DATE(updated_at)'))
            ->orderBy('date')
            ->get();

        // Fetch Tasks
        $tasks = Task::selectRaw('type, DATE(updated_at) as date, SUM(price) as total')
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->groupBy('type', DB::raw('DATE(updated_at)'))
            ->orderBy('date')
            ->get();

        // Merge Orders + Tasks
        $allData = $orders->concat($tasks);

        $grouped = $allData->groupBy('type');

        $series = [];

        foreach ($grouped as $type => $items) {
            $data = $items->map(fn($item) => [
                'x' => Carbon::parse($item->date)->format('Y-m-d'),
                'y' => (float) $item->total,
            ])->values()->all();

            $series[] = [
                'name' => $typeLabels[$type] ?? ucfirst($type),
                'data' => $data,
            ];
        }

        return $series;
    }

    public function render()
    {
        return view('livewire.sales-line-chart');
    }
}
