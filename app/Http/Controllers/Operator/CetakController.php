<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Cabang;
use App\Models\DataBank;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;
use Carbon\Carbon;

class CetakController extends Controller
{
    /**
     * Display the printing index page.
     */
    public function index()
    {
        $cabang = Cabang::all();
        $statusPernikahan = Peserta::select('status_kawin')
                        ->distinct()
                        ->whereNotNull('status_kawin')
                        ->pluck('status_kawin');
        $pendidikanTerakhir = Peserta::whereNotNull('pendidikan')
                        ->select('pendidikan')
                        ->distinct()
                        ->orderBy('pendidikan')
                        ->pluck('pendidikan');
        $golonganList = Peserta::whereNotNull('golongan')
                        ->select('golongan')
                        ->distinct()
                        ->orderBy('golongan')
                        ->pluck('golongan');
        
        return view('operator.cetak.cetak', compact('cabang','statusPernikahan','pendidikanTerakhir','golonganList'));
    }

    /**
     * Fetch data for AJAX requests
     */
    public function fetchData(Request $request)
    {
        try {
            // Get filters from request
            $filters = [
                'umur_min' => $request->input('umur_min', 18),
                'umur_max' => $request->input('umur_max', 65),
                'cabang' => $request->input('cabang'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'status_kawin' => $request->input('status_kawin'),
                'pendidikan' => $request->input('pendidikan'),
                'phdp_min' => $request->input('phdp_min'),
                'phdp_max' => $request->input('phdp_max'),
                'golongan' => $request->input('golongan'),
            ];

            // Get report type
            $jenis_laporan = $request->input('jenis_laporan', 'umum');

            // Apply filters and get data with relationships
            $query = Peserta::with('cabang');
            
            // Add keluargas relationship for keluarga report
            if ($jenis_laporan === 'keluarga') {
                $query->with('keluargas');
            }
            
            $peserta = $query->applyPrintFilter($filters)->get();

            return response()->json([
                'data' => $peserta,
                'filters' => $filters,
                'jenis_laporan' => $jenis_laporan,
                'total' => $peserta->count(),
                'success' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengambil data: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    /**
     * Get preview data based on filters.
     */
    public function preview(Request $request)
    {
        try {
            $filters = $request->except(['_token']);
            $jenis_laporan = $request->input('jenis_laporan', 'umum');

            if ($jenis_laporan === 'anak_25') {
                $tanggalAwal = Carbon::now()->subYears(25); // 25 tahun yang lalu
                $tanggalAkhir = Carbon::now()->subYears(22); // 22 tahun yang lalu

                $anak25 = Keluarga::with('peserta')
                    ->where('hubungan', 'Anak')
                    ->whereBetween('tanggal_lahir', [$tanggalAwal, $tanggalAkhir])
                    ->get();

                return view('operator.cetak.preview_anak25', compact('anak25','filters'));
            }

            if ($jenis_laporan === 'rekap_cabang') {
                $data = \DB::table('tablecabang as c')
                    ->leftJoin('tablepeserta as p', 'c.kode_cabang', '=', 'p.kode_cabang')
                    ->select(
                        'c.kode_cabang',
                        'c.nama_cabang',
                        \DB::raw('COUNT(p.nip) as total_peserta'),
                        \DB::raw('COALESCE(SUM(p.phdp), 0) as total_phdp')
                    )
                    ->groupBy('c.kode_cabang', 'c.nama_cabang')
                    ->orderBy('c.nama_cabang')
                    ->get();

                return view('operator.cetak.preview_rekap_cabang', compact('data', 'filters'));
            }

            if ($jenis_laporan === 'rekap_bank') {
                $banks = DataBank::with(['peserta' => function ($query) {
                    // Hapus 'id', karena tidak ada. Ambil hanya yang diperlukan
                    $query->select('kode_cabang', 'phdp');
                }])->get();

                $rekap = [];
                $totalPeserta = 0;
                $totalPhdp = 0;

                foreach ($banks as $bank) {
                    $jumlahPeserta = $bank->peserta->count();
                    $rataPhdp = $bank->peserta->avg('phdp') ?? 0;
                    $sumPhdp = $bank->peserta->sum('phdp');

                    $rekap[] = [
                        'kode_bank' => $bank->kode_bank,
                        'nama_bank' => $bank->nama_bank,
                        'kode_cabang' => $bank->kode_cabang,
                        'nama_cabang' => $bank->nama_cabang,
                        'kode_full' => $bank->kode_full,
                        'alamat' => $bank->alamat,
                        'jumlah_peserta' => $jumlahPeserta,
                        'rata_phdp' => $rataPhdp,
                    ];

                    $totalPeserta += $jumlahPeserta;
                    $totalPhdp += $sumPhdp;
                }

                $jumlahCabang = $banks->count();
                $rataPhdp = $totalPeserta > 0 ? $totalPhdp / $totalPeserta : 0;
                $date = now()->format('d F Y');

                return view('operator.cetak.preview_rekapbank', compact(
                    'rekap',
                    'totalPeserta',
                    'jumlahCabang',
                    'totalPhdp',
                    'rataPhdp',
                    'date'
                ));
            }

            // Build query with relationships
            $query = Peserta::with('cabang');
            
            // Add keluargas relationship for keluarga report
            if ($jenis_laporan === 'keluarga') {
                $query->with('keluargas');
            }
            
            $peserta = $query->applyPrintFilter($filters)->get();
            
            // Return appropriate view based on report type
            switch ($jenis_laporan) {
                case 'detail':
                    return view('operator.cetak.preview_detail', compact('peserta', 'filters'));
                case 'keluarga':
                    return view('operator.cetak.preview_keluarga', compact('peserta', 'filters'));
                default:
                    return view('operator.cetak.preview_umum', compact('peserta', 'filters'));
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal membuat preview: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate PDF report.
     */
   public function generatePDF(Request $request)
    {
        try {
            $filters = $request->except(['_token']);
            $jenis_laporan = $request->input('jenis_laporan', 'umum');

            if ($jenis_laporan === 'anak_25') {
                $tanggalAwal = Carbon::now()->subYears(25);
                $tanggalAkhir = Carbon::now()->subYears(22);

                $anak25 = Keluarga::with('peserta')
                    ->where('hubungan', 'Anak')
                    ->whereBetween('tanggal_lahir', [$tanggalAwal, $tanggalAkhir])
                    ->get();

                $data = [
                    'anak25' => $anak25,
                    'filters' => $filters,
                    'date' => now()->format('d F Y'),
                ];

                $pdf = PDF::loadView('pdf.anak25', $data)->setPaper('a4', 'portrait');
                $filename = 'laporan_anak25_peserta_' . date('Ymd_His') . '.pdf';

                return $pdf->download($filename);
            }

            if ($jenis_laporan === 'rekap_cabang') {
                $data = \DB::table('tablecabang as c')
                    ->leftJoin('tablepeserta as p', 'c.kode_cabang', '=', 'p.kode_cabang')
                    ->select(
                        'c.kode_cabang',
                        'c.nama_cabang',
                        \DB::raw('COUNT(p.nip) as total_peserta'),
                        \DB::raw('COALESCE(SUM(p.phdp), 0) as total_phdp')
                    )
                    ->groupBy('c.kode_cabang', 'c.nama_cabang')
                    ->orderBy('c.nama_cabang')
                    ->get();

                $pdf = \PDF::loadView('pdf.rekap_cabang', [
                    'data' => $data,
                    'filters' => $filters,
                    'date' => now()->format('d F Y'),
                ])->setPaper('a4', 'portrait');

                $filename = 'laporan_rekap_cabang_' . date('Ymd_His') . '.pdf';

                return $pdf->download($filename);
            }

            if ($jenis_laporan === 'rekap_bank') {
                $rekap = DataBank::with(['peserta' => function ($query) {
                    $query->select('kode_cabang', 'phdp');
                }])->get()->map(function ($bank) {
                    $jumlah_peserta = $bank->peserta->count();
                    $rata_phdp = $bank->peserta->avg('phdp') ?? 0;

                    return [
                        'kode_bank' => $bank->kode_bank,
                        'nama_bank' => $bank->nama_bank,
                        'kode_cabang' => $bank->kode_cabang,
                        'nama_cabang' => $bank->nama_cabang,
                        'kode_full' => $bank->kode_full,
                        'jumlah_peserta' => $jumlah_peserta,
                        'rata_phdp' => $rata_phdp,
                    ];
                });

                $totalPeserta = $rekap->sum('jumlah_peserta');
                $jumlahCabang = $rekap->count();
                $totalPhdp = $rekap->sum('rata_phdp') * $totalPeserta;
                $rataPhdp = $totalPeserta > 0 ? $totalPhdp / $totalPeserta : 0;

                $pdf = PDF::loadView('pdf.rekap_bank', [
                    'rekap' => $rekap,
                    'totalPeserta' => $totalPeserta,
                    'jumlahCabang' => $jumlahCabang,
                    'totalPhdp' => $totalPhdp,
                    'rataPhdp' => $rataPhdp,
                    'date' => now()->format('d F Y'),
                ])->setPaper('a4', 'portrait');

                return $pdf->download('laporan_rekap_bank_' . date('Ymd_His') . '.pdf');
            }



            // ➤ Laporan selain anak_25 lanjut seperti biasa
            $query = Peserta::with('cabang');

            if ($jenis_laporan === 'keluarga') {
                $query->with('keluargas');
            }

            $peserta = $query->applyPrintFilter($filters)->get();

            $peserta = $peserta->map(function ($item) {
                if ($item->tanggal_lahir) {
                    $item->formatted_tanggal_lahir = date('d-m-Y', strtotime($item->tanggal_lahir));
                }
                if ($item->tmk) {
                    $item->formatted_tanggal_masuk = date('d-m-Y', strtotime($item->tmk));
                }
                return $item;
            });

            $data = [
                'peserta' => $peserta,
                'filters' => $filters,
                'jenis_laporan' => $jenis_laporan,
                'total' => $peserta->count(),
                'date' => now()->format('d F Y'),
            ];

            $viewPath = match($jenis_laporan) {
                'detail' => 'pdf.detail',
                'keluarga' => 'pdf.keluarga',
                default => 'pdf.umum',
            };

            $pdf = PDF::loadView($viewPath, $data);
            $pdf->setPaper('a4', ($jenis_laporan == 'detail' || $jenis_laporan == 'keluarga') ? 'portrait' : 'potrait');

            $filename = 'laporan_' . $jenis_laporan . '_peserta_' . date('Ymd_His') . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal membuat PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export data to Excel.
     */
    public function export(Request $request)
    {
        try {
            // Get filters and report type
            $filters = $request->except(['_token']);
            $jenis_laporan = $request->input('jenis_laporan', 'umum');

            // Validate jenis_laporan
            $allowedTypes = ['umum', 'detail', 'keluarga'];
            if (!in_array($jenis_laporan, $allowedTypes)) {
                $jenis_laporan = 'umum';
            }

            // Create export instance
            $export = new PesertaExport($filters, $jenis_laporan);

            // Generate filename with Indonesian date
            $date = now()->format('Y_m_d_H_i_s');
            $filename = 'laporan_' . $jenis_laporan . '_peserta_' . $date . '.xlsx';

            // Download Excel file
            return Excel::download($export, $filename);

        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Excel Export Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => 'Gagal membuat Excel: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    /**
     * Get data for specific report type (helper method)
     */
    private function getReportData($filters, $jenisLaporan)
    {
        $query = Peserta::with('cabang');
        
        if ($jenisLaporan === 'keluarga') {
            $query->with('keluargas');
        }
        
        return $query->applyPrintFilter($filters)->get();
    }

    /**
     * Validate filters (helper method)
     */
    private function validateFilters($filters)
    {
        // Clean and validate filters
        $cleanFilters = [];
        
        foreach ($filters as $key => $value) {
            if (!is_null($value) && $value !== '') {
                $cleanFilters[$key] = $value;
            }
        }
        
        // Set default values if needed
        if (!isset($cleanFilters['umur_min'])) {
            $cleanFilters['umur_min'] = 18;
        }
        if (!isset($cleanFilters['umur_max'])) {
            $cleanFilters['umur_max'] = 65;
        }
        
        return $cleanFilters;
    }

    /**
     * Get summary statistics
     */
    public function getSummary(Request $request)
    {
        try {
            $filters = $request->except(['_token']);
            $peserta = Peserta::applyPrintFilter($filters)->get();
            
            $summary = [
                'total' => $peserta->count(),
                'laki_laki' => $peserta->where('jenis_kelamin', 'Laki-laki')->count(),
                'perempuan' => $peserta->where('jenis_kelamin', 'Perempuan')->count(),
                'menikah' => $peserta->where('status_kawin', 'Menikah')->count(),
                'belum_menikah' => $peserta->where('status_kawin', 'Belum Menikah')->count(),
                'total_phdp' => $peserta->sum('phdp')
            ];
            
            return response()->json([
                'summary' => $summary,
                'success' => true
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengambil ringkasan: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}