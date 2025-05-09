<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PesertaExport extends Controller
{
    public function exportPeserta()
    {
        return Excel::download(new PesertaExport, 'Reporting.xlsx');
    }
}
