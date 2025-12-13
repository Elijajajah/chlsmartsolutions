<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExpensesExport implements FromArray, WithEvents
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    public function array(): array
    {
        $expenses = Expense::whereBetween('expense_date', [$this->startDate, now()])
            ->orderBy('expense_date', 'asc')
            ->get();

        $rows = [
            ['', '', '', '', ''], // Row 1
            ['', '', '', '', ''], // Row 2
            ['', '', '', '', ''], // Row 3
            ['EXPENSES REPORT', '', '', '', ''],
            ['No.', 'Date', 'Category', 'Remarks', 'Amount'],
        ];

        $no = 1;

        foreach ($expenses as $expense) {
            $rows[] = [
                $no++,
                Carbon::parse($expense->expense_date)->format('Y-m-d'),
                ucwords($expense->category),
                $expense->remarks ?? '',
                (float) $expense->amount,
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
                $sheet->mergeCells('B1:E1');
                $sheet->mergeCells('B2:E2');
                $sheet->mergeCells('B3:E3');

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

                $sheet->mergeCells('A4:E4');
                $sheet->getRowDimension(4)->setRowHeight(32);

                $sheet->getStyle('A4:E4')->applyFromArray([
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

                $sheet->getStyle('A5:E5')->applyFromArray([
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
                $sheet->getColumnDimension('C')->setWidth(22);  // Category
                $sheet->getColumnDimension('D')->setWidth(40);  // Remarks
                $sheet->getColumnDimension('E')->setWidth(20);  // Amount

                /* ================= DATA ALIGNMENT ================= */

                $sheet->getStyle("A6:E{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                ]);

                $sheet->getStyle("C6:D{$lastRow}")
                    ->getAlignment()
                    ->setIndent(2);

                /* ================= CURRENCY ================= */

                $sheet->getStyle("E6:E{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');

                /* ================= GRAND TOTAL ================= */

                $grandTotalRow = $lastRow + 1;
                $grandTotal = 0;

                for ($row = 6; $row <= $lastRow; $row++) {
                    $value = $sheet->getCell("E{$row}")->getValue();
                    if (is_numeric($value)) {
                        $grandTotal += $value;
                    }
                }

                $sheet->setCellValue("D{$grandTotalRow}", 'GRAND TOTAL');
                $sheet->setCellValue("E{$grandTotalRow}", $grandTotal);

                $sheet->getStyle("A{$grandTotalRow}:E{$grandTotalRow}")->applyFromArray([
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

                $sheet->getStyle("E{$grandTotalRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');

                /* ================= BORDERS ================= */

                $sheet->getStyle("A4:E{$grandTotalRow}")->applyFromArray([
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
