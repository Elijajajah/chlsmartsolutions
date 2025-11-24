<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Exports\SalesExport;
use App\Exports\ServicesExport;
use App\Exports\ExpensesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CSVExportController
{
    public function exportSales(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());
        return Excel::download(new SalesExport($startDate), 'sales.xlsx');
    }

    public function exportServices(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());
        return Excel::download(new ServicesExport($startDate), 'services.xlsx');
    }

    public function exportExpenses(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());
        return Excel::download(new ExpensesExport($startDate), 'expenses.xlsx');
    }

    // Export all (Sales + Services + Expenses) in a ZIP
    public function exportAll(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());

        // Generate CSV/XLSX content in memory
        $salesXlsx = Excel::raw(new SalesExport($startDate), \Maatwebsite\Excel\Excel::XLSX);
        $servicesXlsx = Excel::raw(new ServicesExport($startDate), \Maatwebsite\Excel\Excel::XLSX);
        $expensesXlsx = Excel::raw(new ExpensesExport($startDate), \Maatwebsite\Excel\Excel::XLSX);

        // Create temp zip file
        $zipFilePath = tempnam(sys_get_temp_dir(), 'all_reports_');
        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $zip->addFromString('sales.xlsx', $salesXlsx);
            $zip->addFromString('services.xlsx', $servicesXlsx);
            $zip->addFromString('expenses.xlsx', $expensesXlsx);
            $zip->close();
        } else {
            abort(500, 'Failed to create zip archive.');
        }

        return response()->download($zipFilePath, 'all_reports.zip', [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    // Optional: Export only Sales + Services in a zip
    public function exportSalesAndServices(Request $request)
    {
        $startDate = $request->query('startDate', now()->startOfYear()->toDateString());

        $salesXlsx = Excel::raw(new SalesExport($startDate), \Maatwebsite\Excel\Excel::XLSX);
        $servicesXlsx = Excel::raw(new ServicesExport($startDate), \Maatwebsite\Excel\Excel::XLSX);

        $zipFilePath = tempnam(sys_get_temp_dir(), 'sales_services_');
        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $zip->addFromString('sales.xlsx', $salesXlsx);
            $zip->addFromString('services.xlsx', $servicesXlsx);
            $zip->close();
        } else {
            abort(500, 'Failed to create zip archive.');
        }

        return response()->download($zipFilePath, 'sales_services.zip', [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }
}
