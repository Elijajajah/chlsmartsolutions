<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Expense;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;

class ExpensesExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        // Fetch all expenses within the date range
        $expenses = Expense::whereBetween('expense_date', [$this->startDate, now()])
            ->orderBy('expense_date', 'asc')
            ->get();

        // Initialize result array with headers
        $result = [[
            'Date',
            'Category',
            'Description',
            'Amount'
        ]];

        $grandTotal = 0;

        foreach ($expenses as $expense) {
            $amount = (float) $expense->amount;
            $grandTotal += $amount;

            $result[] = [
                Carbon::parse($expense->expense_date)->format('Y-m-d'),
                $expense->category,
                $expense->description ?? '',
                $amount,
            ];
        }

        // Add grand total row
        $result[] = ['Grand Total', '', '', $grandTotal];

        return $result;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // BOLD HEADER
                $sheet->getStyle('A1:E1')->getFont()->setBold(true);

                // Lock the sheet
                $sheet->getProtection()->setSheet(true);

                // Optional: set a password
                $sheet->getProtection()->setPassword('mypassword');

                // Optional: restrict sort/insert
                $sheet->getProtection()->setSort(false);
                $sheet->getProtection()->setInsertRows(false);
            }
        ];
    }
}
