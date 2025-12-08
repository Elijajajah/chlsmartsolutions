<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsExport implements FromArray, ShouldAutoSize, WithEvents
{
    public function array(): array
    {
        $products = Product::with([
            'supplier',
            'serials' => function ($q) {
                $q->where('status', '!=', 'sold');
            }
        ])->get();

        $result = [
            ['Product Name', 'Serial Number', 'Supplier', 'Original Price', 'Retail Price']
        ];

        foreach ($products as $product) {

            if ($product->serials->count() == 0) {
                // No serials
                $result[] = [
                    $product->name,
                    'N/A',
                    $product->supplier->name ?? 'N/A',
                    $product->original_price,
                    $product->retail_price,
                ];
            } else {
                // First row: include product info
                foreach ($product->serials as $index => $serial) {
                    if ($index === 0) {
                        $result[] = [
                            $product->name,
                            $serial->serial_number,
                            $product->supplier->name ?? 'N/A',
                            $product->original_price,
                            $product->retail_price,
                        ];
                    } else {
                        // Following rows: only serial number
                        $result[] = [
                            '',
                            $serial->serial_number,
                            '',
                            '',
                            '',
                        ];
                    }
                }
            }
        }

        return $result;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // BOLD HEADER
                $sheet->getStyle('A1:E1')->getFont()->setBold(true);

                // Lock sheet
                $sheet->getProtection()->setSheet(true);
                $sheet->getProtection()->setPassword('mypassword');

                // Disable sorting / inserting rows (optional)
                $sheet->getProtection()->setSort(false);
                $sheet->getProtection()->setInsertRows(false);
            }
        ];
    }
}
