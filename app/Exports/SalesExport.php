<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalesExport implements FromArray, WithEvents
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        $orders = Order::where('status', 'completed')
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->orderBy('updated_at', 'asc')
            ->get();

        $rows = [
            ['', '', '', ''], // Row 1
            ['', '', '', ''], // Row 2
            ['', '', '', ''], // Row 3
            ['SALES REPORT', '', '', ''],
            ['No.', 'Date', 'Type', 'Total Amount'],
        ];

        $no = 1;

        foreach ($orders as $order) {
            $rows[] = [
                $no++,
                Carbon::parse($order->updated_at)->format('Y-m-d'),
                ucfirst(str_replace('_', ' ', $order->type)),
                (float) $order->total_amount,
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                /* ================= HEADER LAYOUT ================= */

                $sheet->getRowDimension(1)->setRowHeight(42);
                $sheet->getRowDimension(2)->setRowHeight(20);
                $sheet->getRowDimension(3)->setRowHeight(20);

                $sheet->mergeCells('A1:A3');
                $sheet->mergeCells('B1:D1');
                $sheet->mergeCells('B2:D2');
                $sheet->mergeCells('B3:D3');

                $sheet->setCellValue('B1', 'CHL Distri&IT Solutions');
                $sheet->setCellValue('B2', '2nd Flr. Vanessa Building, Malusak, Boac Marinduque, Boac, Philippines');
                $sheet->setCellValue('B3', 'Contact: (+63) 999 226 4818 | CHL E-mail Address: chldisty888@gmail.com');

                $sheet->getStyle('B1:B3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('B1')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                        'size'  => 28,
                        'color' => ['rgb' => '4EA72E'],
                    ],
                ]);

                $sheet->getStyle('B2')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                    ],
                ]);

                $sheet->getStyle('B2:B3')->getFont()->setSize(10);

                /* ================= LOGO ================= */

                $logo = new Drawing();
                $logo->setName('Company Logo');
                $logo->setPath(public_path('images/chlss_logo.png'));
                $logo->setCoordinates('A1');
                $logo->setEditAs(BaseDrawing::EDIT_AS_ONECELL);
                $logo->setResizeProportional(true);
                $logo->setHeight(50);
                $logo->setOffsetX(20);
                $logo->setOffsetY(30);
                $logo->setWorksheet($sheet);

                /* ================= TITLE ================= */

                $sheet->mergeCells('A4:D4');
                $sheet->getRowDimension(4)->setRowHeight(32);

                $sheet->getStyle('A4:D4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4EA72E'],
                    ],
                ]);

                /* ================= COLUMN HEADERS ================= */

                $sheet->getRowDimension(5)->setRowHeight(18);

                $sheet->getStyle('A5:D5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '8ED973'],
                    ],
                ]);

                /* ================= COLUMN WIDTHS ================= */

                $sheet->getColumnDimension('A')->setWidth(13);   // No.
                $sheet->getColumnDimension('B')->setWidth(15);  // Date
                $sheet->getColumnDimension('C')->setWidth(30);  // Type
                $sheet->getColumnDimension('D')->setWidth(25);  // Amount

                /* ================= DATA ALIGNMENT ================= */

                $sheet->getStyle("A6:D{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                ]);

                /* ================= CURRENCY ================= */

                $sheet->getStyle("D6:D{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');

                /* ================= GRAND TOTAL ================= */

                $grandTotalRow = $lastRow + 1;
                $grandTotal = 0;

                for ($row = 6; $row <= $lastRow; $row++) {
                    $value = $sheet->getCell("D{$row}")->getValue();
                    if (is_numeric($value)) {
                        $grandTotal += $value;
                    }
                }

                $sheet->setCellValue("C{$grandTotalRow}", 'GRAND TOTAL');
                $sheet->setCellValue("D{$grandTotalRow}", $grandTotal);

                $sheet->getStyle("A{$grandTotalRow}:D{$grandTotalRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4EA72E'],
                    ],
                ]);

                $sheet->getStyle("D{$grandTotalRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');

                /* ================= BORDERS ================= */

                $sheet->getStyle("A4:D{$grandTotalRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                /* ================= PROTECTION ================= */

                $sheet->getProtection()->setSheet(true);
                $sheet->getProtection()->setPassword('mypassword');
            }
        ];
    }
}
