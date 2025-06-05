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

class HitungIuranController extends Controller
{
    /**
     * Menampilkan form input untuk perhitungan iuran dan daftar peserta.
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

        return view('operator.hitung.index', compact(
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


        return view('operator.hitung.detail', compact(
            'peserta',
            'historiIuran',
            'tahun',
            'bulan',
            'availableYearsForPeserta',
            'availableMonthsForPeserta'
        ));
    }


    /**
     * Memproses perhitungan iuran untuk satu peserta dan menyimpan hasilnya.
     */
    public function hitung(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|exists:tablepeserta,nip',
            'tahun' => 'required|integer|min:1900',
            'bulan' => 'required|integer|min:1|max:12',
            'phdp' => 'required|numeric|min:0',
            'ir' => 'required|numeric|min:0', // IR dalam persen, e.g., 5.5
        ]);

        $nip = $request->input('nip');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $phdp_input = $request->input('phdp');
        $ir_input = $request->input('ir'); // Dalam persen, misal 5.5

        $peserta = Peserta::where('nip', $nip)->firstOrFail();

        // Konversi IR dari persen ke desimal (misal 5.5 -> 0.055)
        $ir_decimal = $ir_input / 100;

        // Ambil saldo awal dari bulan sebelumnya
        // Jika ini bulan Januari, ambil dari akumulasi_ibhp peserta
        // Jika bulan lainnya, ambil dari saldo_akhir_peserta dan saldo_akhir_pemberi_kerja bulan sebelumnya
        $saldo_awal_peserta = 0;
        $saldo_awal_pemberi_kerja = 0;

        $bulan_sebelumnya = $bulan - 1;
        $tahun_sebelumnya = $tahun;

        if ($bulan_sebelumnya == 0) { // Jika bulan Januari, ambil data dari Des tahun sebelumnya
            $bulan_sebelumnya = 12;
            $tahun_sebelumnya = $tahun - 1;
        }

        $last_month_histori = HistoriIuranPeserta::where('nip', $nip)
                                                ->where('tahun', $tahun_sebelumnya)
                                                ->where('bulan', $bulan_sebelumnya)
                                                ->first();

        if ($last_month_histori) {
            $saldo_awal_peserta = $last_month_histori->saldo_akhir_peserta;
            $saldo_awal_pemberi_kerja = $last_month_histori->saldo_akhir_pemberi_kerja;
        } else {
            // Jika tidak ada histori bulan sebelumnya, ambil dari akumulasi_ibhp peserta
            // Ini berarti ini adalah bulan pertama perhitungan untuk peserta tersebut
            $saldo_awal_peserta = $peserta->akumulasi_ibhp ?? 0;
            $saldo_awal_pemberi_kerja = 0; // Asumsi saldo awal PK 0 jika tidak ada histori
        }

        // --- RUMUS PERHITUNGAN IURAN ---
        // Konstanta persentase (karena tidak ada tabel parameter)
        $persen_iuran_peserta = 0.04; // 4%
        $persen_iuran_pemberi_kerja = 0.2710; // Menggunakan 27.10% agar sesuai contoh desktop app

        // Perhitungan Iuran Peserta
        $iuran_peserta = $phdp_input * $persen_iuran_peserta;
        $hasil_pengembangan_peserta = ($saldo_awal_peserta * $ir_decimal) / 12;
        $saldo_akhir_peserta = $saldo_awal_peserta + $iuran_peserta + $hasil_pengembangan_peserta;

        // Perhitungan Iuran Pemberi Kerja
        $iuran_pemberi_kerja = $phdp_input * $persen_iuran_pemberi_kerja;
        $hasil_pengembangan_pemberi_kerja = ($saldo_awal_pemberi_kerja * $ir_decimal) / 12;
        $saldo_akhir_pemberi_kerja = $saldo_awal_pemberi_kerja + $iuran_pemberi_kerja + $hasil_pengembangan_pemberi_kerja;


        // --- SIMPAN / UPDATE HASIL PERHITUNGAN ---
        try {
            DB::beginTransaction();

            // Cari atau buat histori untuk bulan ini
            $histori = HistoriIuranPeserta::updateOrCreate(
                ['nip' => $nip, 'tahun' => $tahun, 'bulan' => $bulan],
                [
                    'phdp_bulan_ini' => $phdp_input,
                    'ir_bulan_ini' => $ir_input,
                    'saldo_awal_peserta' => $saldo_awal_peserta,
                    'iuran_peserta' => $iuran_peserta,
                    'hasil_pengembangan_peserta' => $hasil_pengembangan_peserta,
                    'saldo_akhir_peserta' => $saldo_akhir_peserta,
                    'saldo_awal_pemberi_kerja' => $saldo_awal_pemberi_kerja,
                    'iuran_pemberi_kerja' => $iuran_pemberi_kerja,
                    'hasil_pengembangan_pemberi_kerja' => $hasil_pengembangan_pemberi_kerja,
                    'saldo_akhir_pemberi_kerja' => $saldo_akhir_pemberi_kerja,
                ]
            );

            DB::commit();

            return redirect()->route('operator.hitung.detail', ['nip' => $nip, 'tahun' => $tahun, 'bulan' => $bulan])
                             ->with('success', 'Perhitungan iuran berhasil disimpan untuk ' . Carbon::create($tahun, $bulan)->format('F Y') . '.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving iuran calculation: ' . $e->getMessage() . ' for NIP: ' . $nip . ' ' . $tahun . '-' . $bulan);
            return redirect()->back()->with('error', 'Gagal menyimpan perhitungan iuran: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Metode untuk menghapus histori iuran bulanan.
     */
    public function destroyHistori($id)
    {
        try {
            $histori = HistoriIuranPeserta::findOrFail($id);
            $nip = $histori->nip;
            $histori->delete();

            // Setelah menghapus, perlu memperbarui saldo bulan-bulan berikutnya jika ada
            // Ini adalah logika kompleks yang butuh pertimbangan lebih lanjut
            // Untuk kesederhanaan awal, kita hanya menghapus satu entri.
            // Jika ingin otomatis update semua bulan setelahnya, perlu iterasi dan recalculate.

            return redirect()->route('operator.hitung.detail', ['nip' => $nip])
                             ->with('success', 'Histori iuran berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting histori iuran: ' . $e->getMessage() . ' for ID: ' . $id);
            return redirect()->back()->with('error', 'Gagal menghapus histori iuran: ' . $e->getMessage());
        }
    }

    /**
     * Metode untuk memuat data PHDP dan IR bulan sebelumnya via AJAX (jika diperlukan)
     */
    public function getPreviousMonthData(Request $request)
    {
        $nip = $request->input('nip');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        $bulan_sebelumnya = $bulan - 1;
        $tahun_sebelumnya = $tahun;

        if ($bulan_sebelumnya == 0) {
            $bulan_sebelumnya = 12;
            $tahun_sebelumnya = $tahun - 1;
        }

        $last_month_histori = HistoriIuranPeserta::where('nip', $nip)
                                                ->where('tahun', $tahun_sebelumnya)
                                                ->where('bulan', $bulan_sebelumnya)
                                                ->first();

        if ($last_month_histori) {
            return response()->json([
                'success' => true,
                'phdp' => $last_month_histori->phdp_bulan_ini,
                'ir' => $last_month_histori->ir_bulan_ini,
                'saldo_akhir_peserta' => $last_month_histori->saldo_akhir_peserta,
                'saldo_akhir_pemberi_kerja' => $last_month_histori->saldo_akhir_pemberi_kerja,
            ]);
        } else {
            // Jika tidak ada histori bulan sebelumnya, ambil PHDP dari data peserta master
            $peserta = Peserta::where('nip', $nip)->first();
            return response()->json([
                'success' => true,
                'phdp' => $peserta->phdp ?? 0, // PHDP dari master peserta
                'ir' => 5.5, // Default IR jika tidak ada histori
                'saldo_akhir_peserta' => $peserta->akumulasi_ibhp ?? 0, // Akumulasi IBHP dari master peserta
                'saldo_akhir_pemberi_kerja' => 0, // Asumsi 0 untuk PK jika tidak ada histori
            ]);
        }
    }
}