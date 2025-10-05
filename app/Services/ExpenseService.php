<?php

namespace App\Services;

use App\Models\Expense;

class ExpenseService
{
    public function getFilteredExpensePaginated($startDate, $category)
    {
        return Expense::where('category', $category)
            ->whereBetween('expense_date', [$startDate, now()])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getFilteredExpense($startDate)
    {
        return Expense::whereBetween('expense_date', [$startDate, now()])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
