<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Carbon\Carbon;

class ExpensesExport implements FromArray
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        $expenses = Expense::selectRaw('category, DATE(expense_date) as date, SUM(amount) as amount')
            ->whereBetween('expense_date', [$this->startDate, now()])
            ->groupBy('category', DB::raw('DATE(expense_date)'))
            ->orderBy('date')
            ->get();

        $grouped = [];

        foreach ($expenses as $expense) {
            $date = Carbon::parse($expense->date)->format('Y-m-d');
            $category = strtolower($expense->category);
            $amount = (float) $expense->amount;

            if (!isset($grouped[$date])) {
                $grouped[$date] = [
                    'date' => $date,
                    'monthly dues' => 0,
                    'employee salary' => 0,
                    'supplies & materials' => 0,
                    'miscellaneous' => 0,
                    'other expenses' => 0,
                    'total' => 0,
                ];
            }

            switch ($category) {
                case 'monthly dues':
                    $grouped[$date]['monthly dues'] += $amount;
                    break;
                case 'employee salary':
                    $grouped[$date]['employee salary'] += $amount;
                    break;
                case 'supplies & materials':
                    $grouped[$date]['supplies & materials'] += $amount;
                    break;
                case 'miscellaneous':
                    $grouped[$date]['miscellaneous'] += $amount;
                    break;
                case 'other expenses':
                    $grouped[$date]['other expenses'] += $amount;
                    break;
            }

            $grouped[$date]['total'] += $amount;
        }

        // Header
        $result = [[
            'Date',
            'Monthly Dues',
            'Employee Salary',
            'Supplies & Materials',
            'Miscellaneous',
            'Other Expenses',
            'Total'
        ]];

        // Rows
        foreach (array_values($grouped) as $row) {
            $result[] = [
                $row['date'],
                $row['monthly dues'],
                $row['employee salary'],
                $row['supplies & materials'],
                $row['miscellaneous'],
                $row['other expenses'],
                $row['total'],
            ];
        }

        // Grand total
        $grandTotal = [
            'Total',
            collect($grouped)->sum('monthly dues'),
            collect($grouped)->sum('employee salary'),
            collect($grouped)->sum('supplies & materials'),
            collect($grouped)->sum('miscellaneous'),
            collect($grouped)->sum('other expenses'),
            collect($grouped)->sum('total'),
        ];

        $result[] = $grandTotal;

        return $result;
    }
}
