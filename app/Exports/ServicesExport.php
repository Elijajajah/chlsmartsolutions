<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ServicesExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        // Fetch completed tasks within the date range
        $tasks = Task::with('service.serviceCategory')
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->orderBy('updated_at', 'asc')
            ->get();

        // Initialize result array with headers
        $result = [
            ['Customer Name', 'Service', 'Category', 'Type', 'Price', 'Date Completed']
        ];

        $grandTotal = 0;

        foreach ($tasks as $task) {
            $price = (float) $task->price;
            $grandTotal += $price;

            $result[] = [
                $task->customer_name,
                $task->service->service ?? 'N/A',
                $task->service->serviceCategory->category ?? 'N/A',
                ucfirst(str_replace('_', ' ', $task->type)),
                $price,
                Carbon::parse($task->updated_at)->format('Y-m-d'),
            ];
        }

        // Add grand total row
        $result[] = ['Grand Total', '', '', '', $grandTotal, ''];

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
