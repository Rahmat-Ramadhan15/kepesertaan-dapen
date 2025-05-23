<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Cabang;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;
use App\Exports\PesertaCetak;
use Carbon\Carbon;

class CetakController extends Controller
{
    /**
     * Display the printing index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Cabang::all();
        $statusPernikahan = Peserta::select('status_kawin')
                        ->distinct()
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

    public function fetchData(Request $request)
    {
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

        // Apply filters using the model method
        $peserta = Peserta::applyPrintFilter($filters)->get();

        // Return different data based on report type
        $jenis_laporan = $request->input('jenis_laporan', 'umum');

        return response()->json([
            'data' => $peserta,
            'filters' => $filters,
            'jenis_laporan' => $jenis_laporan,
            'total' => $peserta->count()
        ]);
    }
    /**
     * Get preview data based on filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $filters = $request->all();
        $peserta = Peserta::applyPrintFilter($filters)->get();
        
        $jenis_laporan = $request->input('jenis_laporan', 'umum');
        
        switch ($jenis_laporan) {
            case 'detail':
                return view('operator.cetak.preview_detail', compact('peserta', 'filters'));
            case 'keluarga':
                return view('operator.cetak.preview_keluarga', compact('peserta', 'filters'));
            default:
                return view('operator.cetak.preview_umum', compact('peserta', 'filters'));
        }
    }

    /**
     * Generate PDF report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        // Validate filters (same as preview)
        $validated = $request->validate([
            'jenis_laporan' => 'required|in:umum,detail,keluarga',
            'umur_min' => 'required|numeric|min:18',
            'umur_max' => 'required|numeric|max:65',
            'cabang' => 'nullable|exists:cabang,id',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'status_pernikahan' => 'nullable|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'pendidikan' => 'nullable|in:SD,SMP,SMA/SMK,D3,S1,S2,S3',
            'phdp_min' => 'nullable|numeric|min:0',
            'phdp_max' => 'nullable|numeric',
            'golongan' => 'nullable|in:I,II,III,IV',
        ]);

        // Get filtered data
        $query = Peserta::applyPrintFilter($validated);
        $peserta = $query->get();
        
        // Format data
        $peserta = $peserta->map(function ($item) {
            $item->formatted_tanggal_lahir = date('d-m-Y', strtotime($item->tanggal_lahir));
            $item->formatted_tanggal_masuk = date('d-m-Y', strtotime($item->tanggal_masuk));
            return $item;
        });

        // Set data for PDF view
        $data = [
            'peserta' => $peserta,
            'filters' => $validated,
            'jenis_laporan' => $validated['jenis_laporan'],
            'total' => $peserta->count(),
            'date' => now()->format('d F Y'),
        ];

        // Generate PDF
        $pdf = PDF::loadView('cetak.pdf.' . $validated['jenis_laporan'], $data);
        
        // Set paper size and orientation
        if ($validated['jenis_laporan'] == 'detail' || $validated['jenis_laporan'] == 'keluarga') {
            $pdf->setPaper('a4', 'portrait');
        } else {
            $pdf->setPaper('a4', 'landscape');
        }
        
        // Download PDF
        return $pdf->download('laporan_peserta_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Export data to Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function export(Request $request)
     {
         // Mengambil semua filter dari request
         $filters = $request->all();
 
         // Membuat instance export dengan filter yang diterima
         $export = new PesertaExport($filters);
 
         // Tentukan nama file ekspor (bisa disesuaikan)
         $fileName = 'peserta_report_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
 
         // Menggunakan Laravel Excel untuk mengekspor file dan mengunduhnya
         return Excel::download($export, $fileName);
     }
}