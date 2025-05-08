<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

class PesertaExport extends Controller
{
    public function exportPeserta()
    {
        return Excel::download(new PesertaExport, 'Reporting.xlsx');
    }
}
