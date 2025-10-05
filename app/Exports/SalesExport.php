<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Carbon\Carbon;

class SalesExport implements FromArray
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        $orders = Order::selectRaw('type, DATE(created_at) as date, SUM(total_amount) as total_amount')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->groupBy('type', DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $grouped = [];

        foreach ($orders as $order) {
            $date = Carbon::parse($order->date)->format('Y-m-d');
            $type = $order->type;
            $amount = (float) $order->total_amount;

            if (!isset($grouped[$date])) {
                $grouped[$date] = [
                    'date' => $date,
                    'online' => 0,
                    'walk_in' => 0,
                    'government' => 0,
                    'project_based' => 0,
                    'total' => 0,
                ];
            }

            $grouped[$date][$type] += $amount;
            $grouped[$date]['total'] += $amount;
        }

        // Initialize result array with headers
        $result = [
            ['Date', 'Online', 'Walk-In', 'Government', 'Project-Based', 'Total']
        ];

        // Add row data
        foreach (array_values($grouped) as $row) {
            $result[] = [
                $row['date'],
                $row['online'],
                $row['walk_in'],
                $row['government'],
                $row['project_based'],
                $row['total'],
            ];
        }

        // Calculate grand total
        $grandTotal = [
            'Total',
            collect($grouped)->sum('online'),
            collect($grouped)->sum('walk_in'),
            collect($grouped)->sum('government'),
            collect($grouped)->sum('project_based'),
            collect($grouped)->sum('total'),
        ];

        $result[] = $grandTotal;

        return $result;
    }
}
