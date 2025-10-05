<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SalesExport;
use App\Exports\ExpensesExport;
use Maatwebsite\Excel\Facades\Excel;

class CSVExportController
{
    public function exportSales(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());
        return Excel::download(new SalesExport($startDate), 'sales.csv');
    }

    public function exportExpenses(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());
        return Excel::download(new ExpensesExport($startDate), 'expenses.csv');
    }

    public function exportAll(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());

        $salesCsv = Excel::raw(new SalesExport($startDate), \Maatwebsite\Excel\Excel::CSV);
        $expensesCsv = Excel::raw(new ExpensesExport($startDate), \Maatwebsite\Excel\Excel::CSV);

        $zipFilePath = tempnam(sys_get_temp_dir(), 'all_reports_');
        $zip = new \ZipArchive();

        $tempStream = tmpfile();
        $metaData = stream_get_meta_data($tempStream);
        $tmpFilePath = $metaData['uri'];

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $zip->addFromString('sales.csv', $salesCsv);
            $zip->addFromString('expenses.csv', $expensesCsv);
            $zip->close();
        } else {
            abort(500, 'Failed to create zip archive.');
        }

        return response()->download($zipFilePath, 'all_reports.zip', [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }
}
