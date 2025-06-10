<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Cabang;
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
     */
    public function generatePDF(Request $request)
    {
        try {
            // Get filters from request
            $filters = $request->except(['_token']);
            $jenis_laporan = $request->input('jenis_laporan', 'umum');

            // Get filtered data
            $peserta = Peserta::applyPrintFilter($filters)->get();
            
            // Format data for PDF
            $peserta = $peserta->map(function ($item) {
                if ($item->tanggal_lahir) {
                    $item->formatted_tanggal_lahir = date('d-m-Y', strtotime($item->tanggal_lahir));
                }
                if ($item->tmk) { // Changed from tanggal_masuk to tmk based on your model
                    $item->formatted_tanggal_masuk = date('d-m-Y', strtotime($item->tmk));
                }
                return $item;
            });

            // Set data for PDF view
            $data = [
                'peserta' => $peserta,
                'filters' => $filters,
                'jenis_laporan' => $jenis_laporan,
                'total' => $peserta->count(),
                'date' => now()->format('d F Y'),
            ];

            // Determine the correct view path based on jenis_laporan
            $viewPath = '';
            switch ($jenis_laporan) {
                case 'detail':
                    $viewPath = 'pdf.detail'; // This should match your actual view path
                    break;
                case 'keluarga':
                    $viewPath = 'pdf.keluarga'; // This should match your actual view path
                    break;
                default:
                    $viewPath = 'pdf.umum'; // This should match your actual view path
                    break;
            }

            // Generate PDF
            $pdf = PDF::loadView($viewPath, $data);
            
            // Set paper size and orientation
            if ($jenis_laporan == 'detail' || $jenis_laporan == 'keluarga') {
                $pdf->setPaper('a4', 'portrait');
            } else {
                $pdf->setPaper('a4', 'landscape');
            }
            
            // Generate filename
            $filename = 'laporan_' . $jenis_laporan . '_peserta_' . date('Ymd_His') . '.pdf';
            
            // Download PDF
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

            // Create export instance
            $export = new PesertaExport($filters, $jenis_laporan);

            // Generate filename
            $filename = 'laporan_' . $jenis_laporan . '_peserta_' . now()->format('Y_m_d_H_i_s') . '.xlsx';

            // Download Excel file
            return Excel::download($export, $filename);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal membuat Excel: ' . $e->getMessage()
            ], 500);
        }
    }
}