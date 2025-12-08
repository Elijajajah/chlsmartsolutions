<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class SalesExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        // Fetch completed orders within the date range
        $orders = Order::where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->orderBy('updated_at', 'asc')
            ->get();

        // Initialize result array with headers
        $result = [
            ['Date', 'Type', 'Total Amount']
        ];

        $grandTotal = 0;

        foreach ($orders as $order) {
            $amount = (float) $order->total_amount;
            $grandTotal += $amount;

            $result[] = [
                Carbon::parse($order->updated_at)->format('Y-m-d'),
                ucfirst(str_replace('_', ' ', $order->type)),
                $amount,
            ];
        }

        // Add grand total row
        $result[] = ['Grand Total', '', $grandTotal];

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

                // Optional: set password
                $sheet->getProtection()->setPassword('mypassword');

                // Optional: restrict sort/insert
                $sheet->getProtection()->setSort(false);
                $sheet->getProtection()->setInsertRows(false);
            }
        ];
    }
}
