<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProductsExport implements FromArray, WithEvents
{
    public function array(): array
    {
        $products = Product::with([
            'supplier',
            'serials' => function ($q) {
                $q->where('status', '!=', 'sold');
            }
        ])->get();

        $rows = [
            ['', '', '', '', '', ''], // Row 1
            ['', '', '', '', '', ''], // Row 2
            ['', '', '', '', '', ''], // Row 3
            ['PRODUCTS INVENTORY REPORT', '', '', '', '', ''],
            ['No.', 'Product Name', 'Serial Number', 'Supplier', 'Original Price', 'Retail Price']
        ];

        $no = 1;

        foreach ($products as $product) {
            if ($product->serials->isEmpty()) {
                $rows[] = [
                    $no++,
                    $product->name,
                    'Out of Stock',
                    $product->supplier->name ?? 'Out of Stock',
                    $product->original_price,
                    $product->retail_price,
                ];
            } else {
                foreach ($product->serials as $i => $serial) {
                    $rows[] = [
                        $i === 0 ? $no++ : '',
                        $i === 0 ? $product->name : '',
                        $serial->serial_number,
                        $i === 0 ? ($product->supplier->name ?? 'Out of Stock') : '',
                        $i === 0 ? $product->original_price : '',
                        $i === 0 ? $product->retail_price : '',
                    ];
                }
            }
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

                // Column & row sizes
                $sheet->getRowDimension(1)->setRowHeight(42);
                $sheet->getRowDimension(2)->setRowHeight(20);
                $sheet->getRowDimension(3)->setRowHeight(20);

                // Merge logo vertically
                $sheet->mergeCells('A1:A3');

                // Merge company info horizontally
                $sheet->mergeCells('B1:F1');
                $sheet->mergeCells('B2:F2');
                $sheet->mergeCells('B3:F3');

                // Company info text
                $sheet->setCellValue('B1', 'CHL Distri&IT Solutions');
                $sheet->setCellValue('B2', '2nd Flr. Vanessa Building, Malusak, Boac Marinduque, Boac, Philippines');
                $sheet->setCellValue('B3', 'Contact: (+63) 999 226 4818 | CHL E-mail Address: chldisty888@gmail.com');

                // Company text styling
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
                        'color' => [
                            'rgb' => '4EA72E',
                        ],
                    ],
                ]);

                $sheet->getStyle('B2')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                    ],
                ]);

                // Address & contact (smaller)
                $sheet->getStyle('B2:B3')->getFont()
                    ->setSize(10);

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

                $sheet->mergeCells('A4:F4');
                $sheet->getRowDimension(4)->setRowHeight(32);

                $sheet->getStyle('A4:F4')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                        'size'  => 15,
                        'color' => [
                            'rgb' => 'FFFFFF', // 👈 white text
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '4EA72E', // 👈 green background
                        ],
                    ],
                ]);

                /* ================= COLUMN HEADERS ================= */

                $sheet->getRowDimension(5)->setRowHeight(18);

                $sheet->getStyle('A5:F5')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                        'color' => [
                            'rgb' => 'FFFFFF', // white text
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '8ED973', // column header green
                        ],
                    ],
                ]);

                // Currency format
                $sheet->getStyle("E6:F{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');

                // Manual column widths
                $sheet->getColumnDimension('A')->setWidth(13);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(35);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(20);

                // Wrap long text
                $sheet->getStyle("B6:D{$lastRow}")
                    ->getAlignment()
                    ->setWrapText(true);

                /* ================= DATA ALIGNMENT ================= */

                $sheet->getStyle("A6:F{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                ]);

                $sheet->getStyle("B6:D{$lastRow}")
                    ->getAlignment()
                    ->setIndent(2);

                /* ================= GRAND TOTAL ================= */

                $grandTotal = 0;

                for ($row = 6; $row <= $lastRow; $row++) {
                    $value = $sheet->getCell("F{$row}")->getCalculatedValue();
                    if (is_numeric($value)) {
                        $grandTotal += $value;
                    }
                }

                $grandTotalRow = $lastRow + 1;

                $sheet->setCellValue("E{$grandTotalRow}", 'GRAND TOTAL');
                $sheet->setCellValue("F{$grandTotalRow}", $grandTotal);

                $sheet->getStyle("A{$grandTotalRow}:F{$grandTotalRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4EA72E'],
                    ],
                ]);

                $sheet->getStyle("F{$grandTotalRow}")
                    ->getNumberFormat()
                    ->setFormatCode('₱#,##0.00');


                /* ================= BORDERS ================= */

                $sheet->getStyle("A4:F{$grandTotalRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '000000',
                            ],
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
