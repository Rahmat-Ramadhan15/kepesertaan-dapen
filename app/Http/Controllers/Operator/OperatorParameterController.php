<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\DataBank;
use App\Models\Cabang;
use App\Models\Ptkp;
use App\Models\NilaiSekarang; // <<< IMPORT MODEL BARU
use App\Models\NsAnak;        // <<< IMPORT MODEL BARU
use App\Models\NsJanda;       // <<< IMPORT MODEL BARU
use App\Models\NsPegawai;     // <<< IMPORT MODEL BARU
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
        $cabangs = Cabang::all();
        return view('operator.parameters.datacabang', compact('cabangs'));
    }

    public function showPtkp()
    {
        $ptkps = Ptkp::all();
        return view('operator.parameters.ptkp', compact('ptkps'));
    }

    // <<< TAMBAHKAN METODE BARU INI >>>

    public function showNilaiSekarang()
    {
        $nilais = NilaiSekarang::all(); // Mengambil semua data Nilai Sekarang
        return view('operator.parameters.nilaisekarang', compact('nilais'));
    }

    public function showNsAnak()
    {
        $nsAnaks = NsAnak::all(); // Mengambil semua data NS Anak
        return view('operator.parameters.nsanak', compact('nsAnaks'));
    }

    public function showNsJanda()
    {
        $nsJandas = NsJanda::all(); // Mengambil semua data NS Janda
        return view('operator.parameters.nsjanda', compact('nsJandas'));
    }

    public function showNsPegawai()
    {
        $nsPegawais = NsPegawai::all(); // Mengambil semua data NS Pegawai
        return view('operator.parameters.nspegawai', compact('nsPegawais'));
    }
}