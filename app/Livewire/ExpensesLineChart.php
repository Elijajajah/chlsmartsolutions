<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ExpensesLineChart extends Component
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
        $expenses = Expense::selectRaw('category, DATE(expense_date) as date, SUM(amount) as amount')
            ->whereBetween('expense_date', [$this->startDate, now()])
            ->groupBy('category', DB::raw('DATE(expense_date)'))
            ->orderBy('date')
            ->get();

        $groupedExpenses = $expenses->groupBy('category');

        $series = [];

        foreach ($groupedExpenses as $category => $typeExpense) {
            $data = $typeExpense->map(fn($exp) => [
                'x' => Carbon::parse($exp->date)->format('Y-m-d'),
                'y' => (float) $exp->amount
            ])->values()->all();

            $series[] = [
                'name' => ucfirst($category),
                'data' => $data
            ];
        }

        return $series;
    }


    public function render()
    {
        return view('livewire.expenses-line-chart');
    }
}
