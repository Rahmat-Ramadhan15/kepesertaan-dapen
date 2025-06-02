<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\DataBank;
use App\Models\Cabang; // <<< UBAH IMPORT MODELNYA MENJADI Cabang
use App\Models\Ptkp;
use Illuminate\Http\Request;

class OperatorParameterController extends Controller
{
    public function showDataBank()
    {
        $banks = DataBank::all();
        return view('operator.parameters.databank', compact('banks'));
    }

    public function showDataCabang()
    {
        $cabangs = Cabang::all(); // <<< UBAH MODELNYA MENJADI Cabang
        return view('operator.parameters.datacabang', compact('cabangs'));
    }

    public function showPtkp()
    {
        $data = Ptkp::all();
        return view('operator.parameters.ptkp', compact('data'));
    }
}