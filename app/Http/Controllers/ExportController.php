<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPeserta()
    {
        return Excel::download(new ReportExport, 'Reporting.xlsx');
    }
}
