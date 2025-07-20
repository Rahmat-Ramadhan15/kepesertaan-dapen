<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta; // Model Peserta
use App\Models\HistoriIuranPeserta; // Model Histori Iuran Peserta
use App\Models\DataBank; // Untuk daftar cabang/bank di filter peserta
use App\Models\Cabang; // Untuk daftar cabang di filter peserta
use Carbon\Carbon; // Untuk manipulasi tanggal
use App\Services\ManfaatPensiunService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TableKenaikan;
use App\Models\NilaiSekarang;
use App\Models\NilaiAnak;
use App\Models\NilaiJanda;
use App\Models\NilaiPegawai;

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

    public function form($nip)
    {
        $peserta = Peserta::findOrFail($nip);
        $kenaikanOptions = TableKenaikan::all();
        return view('operator.manfaat.form', compact('peserta', 'kenaikanOptions'));
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'nip' => 'required|exists:tablepeserta,nip',
            'jenis'       => 'required|in:normal,dipercepat,cacat,janda/duda,anak,pihakyangditunjuk,pengembalianiuran,pengalihandana,ditunda',
            'metode'      => 'required|in:bulanan,sekaligus',
            'kenaikan'    => 'required|numeric|min:0',
            'status_meninggal' => 'required_if:jenis,janda/duda,anak',
        ]);

        $peserta = Peserta::findOrFail($request->nip);

        // Set tanggal berhenti ke hari ini (otomatis diisi saat proses hitung)
        $peserta->tpst = now();
        $peserta->save();

        // Hitung manfaat pensiun lewat service
        $service = new ManfaatPensiunService();
        $kenaikan = floatval($request->kenaikan);
        $statusMeninggal = $request->input('status_meninggal');
        $nilaiSekarang = 1;
        $hasil = $service->hitung(
            $peserta,
            $request->jenis,
            $request->metode,
            $kenaikan,
            $statusMeninggal,
        $nilaiSekarang
        );

        // Tambahkan jenis pensiun ke hasil agar bisa digunakan di view
        $hasil['jenis'] = $request->jenis;

        // Jika ada error (misal usia belum cukup), tampilkan ke user
        if (isset($hasil['error'])) {
            return back()->withInput()->with('error', $hasil['error']);
        }

        // Jika berhasil, tampilkan hasil dalam bentuk PDF
        $pdf = Pdf::loadView('operator.manfaat.hasil', compact('peserta', 'hasil'));
        return $pdf->stream('manfaat-pensiun.pdf');
    }

}
