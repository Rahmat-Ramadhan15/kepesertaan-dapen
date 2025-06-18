<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta; // Model Peserta
use App\Models\HistoriIuranPeserta; // Model Histori Iuran Peserta
use App\Models\DataBank; // Untuk daftar cabang/bank di filter peserta
use App\Models\Cabang; // Untuk daftar cabang di filter peserta
use Carbon\Carbon; // Untuk manipulasi tanggal

use Illuminate\Support\Facades\DB; // Untuk transaksi database
use Illuminate\Support\Facades\Log; // Untuk logging error
use Maatwebsite\Excel\Facades\Excel;

class ManfaatPensiunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = Peserta::query();

        // Filter berdasarkan cabang (jika ada)
        if ($request->filled('cabang_id')) {
            $query->where('kode_cabang', $request->cabang_id);
        }
        // Filter berdasarkan NIP (jika ada)
        if ($request->filled('nip')) {
            $query->where('nip', 'like', '%' . $request->nip . '%');
        }
        // Filter berdasarkan Nama (jika ada)
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Ambil daftar peserta dengan pagination
        $pesertas = $query->paginate(10)->appends($request->query());

        // Ambil daftar cabang untuk filter dropdown
        $listCabang = Cabang::all();

        // Ambil daftar tahun dan bulan yang tersedia di histori_iuran_peserta
        $availableYears = HistoriIuranPeserta::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $availableMonths = HistoriIuranPeserta::select('bulan')->distinct()->orderBy('bulan', 'asc')->pluck('bulan');

        // Data untuk filter bulan dan tahun di tampilan
        $filterTahun = $request->input('tahun', date('Y')); // Default tahun ini
        $filterBulan = $request->input('bulan', date('n')); // Default bulan ini

        return view('operator.manfaat.index', compact(
            'pesertas',
            'listCabang',
            'filterTahun',
            'filterBulan',
            'availableYears',
            'availableMonths'
        ));
    }

    /**
     * Menampilkan detail perhitungan iuran untuk peserta tertentu.
     */
    public function detail($nip, Request $request)
    {
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        $tahun = $request->input('tahun', date('Y')); // Tahun default
        $bulan = $request->input('bulan', date('n')); // Bulan default

        // Ambil histori iuran untuk peserta ini di bulan & tahun tertentu
        $historiIuran = HistoriIuranPeserta::where('nip', $nip)
                                        ->where('tahun', $tahun)
                                        ->orderBy('bulan', 'asc') // Urutkan berdasarkan bulan
                                        ->get();

        // Ambil daftar tahun dan bulan yang sudah ada histori untuk peserta ini
        $availableYearsForPeserta = HistoriIuranPeserta::where('nip', $nip)
                                            ->select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $availableMonthsForPeserta = HistoriIuranPeserta::where('nip', $nip)
                                             ->where('tahun', $tahun)
                                             ->select('bulan')->distinct()->orderBy('bulan', 'asc')->pluck('bulan');


        return view('operator.manfaat.detail', compact(
            'peserta',
            'historiIuran',
            'tahun',
            'bulan',
            'availableYearsForPeserta',
            'availableMonthsForPeserta'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'jenis_pensiun' => 'required',
        ]);

        $peserta = Peserta::where('nip', $request->nip)->firstOrFail();
        $jenis = $request->jenis_pensiun;

        $mk = $peserta->masa_kerja; // diasumsikan field masa kerja dalam bulan atau tahun
        $phdp = $peserta->phdp;
        $ns = 1; // NS = Nilai Sekarang (nilai default 1 jika tidak diberikan)
        $isDireksi = $peserta->is_direksi; // boolean atau penanda

        $mp = 0;

        switch ($jenis) {
            case 'normal':
                $a = 0.025 * $mk * $phdp;
                $a = min($a, 0.8 * $phdp);
                $mp = $a + 300000;
                if ($isDireksi) {
                    $mp = min(0.025 * $mk * $phdp + 900000, 0.8 * $phdp);
                }
                break;

            case 'dipercepat':
                $a = $ns * 0.025 * $mk * $phdp;
                $a = min($a, 0.8 * $phdp);
                $mp = $a + 300000;
                if ($isDireksi) {
                    $mp = min(0.025 * $mk * $phdp + 900000, 0.8 * $phdp);
                }
                break;

            case 'cacat':
                $a = 0.025 * $mk * $phdp;
                $a = min($a, 0.8 * $phdp);
                $mp = $a + 300000;
                if ($isDireksi) {
                    $mp = min(0.025 * $mk * $phdp + 900000, 0.8 * $phdp);
                }
                break;

            case 'janda_duda':
            case 'anak':
                $a = 0.75 * $ns * 0.025 * $mk * $phdp;
                $mp = $a + 300000;
                if ($isDireksi) {
                    $mp = 0.75 * (0.025 * $mk * $phdp + 900000);
                    $mp = min($mp, 0.8 * $phdp);
                }
                break;

            case 'pihak_ditunjuk':
                $mp = '100% sekaligus'; // ditampilkan sebagai keterangan
                break;

            case 'pengembalian':
                $mp = 'Pengembalian Iuran'; // belum ada rumus
                break;

            case 'alih_dp':
                $mp = 'Pengalihan Dana ke DP Lain'; // belum ada rumus
                break;

            case 'ditunda':
                $a = $ns * 0.025 * $mk * $phdp;
                $a = min($a, 0.8 * $phdp);
                $mp = $a + 300000;
                if ($isDireksi) {
                    $mp = min(0.025 * $mk * $phdp + 900000, 0.8 * $phdp);
                }
                break;

            default:
                return back()->with('error', 'Jenis pensiun tidak dikenali.');
        }

        $mp = ceil($mp / 1000) * 1000; // pembulatan ke atas ribuan

        return view('operator.manfaat.hasil', compact('peserta', 'mp', 'jenis'));
    }


}
