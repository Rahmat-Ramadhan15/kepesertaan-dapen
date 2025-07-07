<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\HistoriIuranPeserta;
use DateTime;


class SupervisorController extends Controller
{
    public function dashboard()
    {
        $peserta = Peserta::all();
        $totalPeserta = $peserta->count();
        $totalLaki = $peserta->where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = $peserta->where('jenis_kelamin', 'Perempuan')->count();
        
        // Calculate total PHDP for the new summary card
        $totalPHDP = $peserta->sum('phdp');
        
        // Calculate average PHDP per job position
        $phdpPerJabatan = $peserta->groupBy('jabatan')->map(function ($group) {
            return round($group->avg('phdp'), 2);
        })->toArray();
        
        $totalJabatan = $peserta->pluck('jabatan')->unique()->count();
        
        // Get user profile data - you can replace this with actual admin data
        $adminData = [
            'name' => 'Admin Utama',
            'role' => 'Super Administrator',
            'notifications' => 3 // Number of unread notifications
        ];
        
        $jumlahPerJabatan = Peserta::select('jabatan', \DB::raw('count(*) as total'))
            ->groupBy('jabatan')
            ->pluck('total', 'jabatan')
            ->toArray();    
       
        return view('supervisor.dashboard', compact(
            'peserta',
            'totalPeserta',
            'totalLaki',
            'totalPerempuan',
            'phdpPerJabatan',
            'totalPHDP',
            'adminData',
            'jumlahPerJabatan',
            'totalJabatan'
        ));
    }
    
    // Optional: Add methods for CRUD operations that would be expected in a Super Admin panel
    
    public function exportData()
    {
        // Logic to export data would go here
        // Return file download or redirect with success message
    }
    
    public function addPeserta(Request $request)
    {
        // Validation logic would go here
        // Peserta::create($request->validated());
        // return redirect()->back()->with('success', 'Peserta berhasil ditambahkan');
    }
    
    public function editPeserta(Request $request, $id)
    {
        // Validation and update logic would go here
        // $peserta = Peserta::findOrFail($id);
        // $peserta->update($request->validated());
        // return redirect()->back()->with('success', 'Peserta berhasil diperbarui');
    }
    
    public function deletePeserta($id)
    {
        // Delete logic would go here
        // Peserta::findOrFail($id)->delete();
        // return redirect()->back()->with('success', 'Peserta berhasil dihapus');
    }

public function laporan(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');

    $peserta = Peserta::all();
    $totalPeserta = $peserta->count();
    $totalLaki = $peserta->where('jenis_kelamin', 'Laki-laki')->count();
    $totalPerempuan = $peserta->where('jenis_kelamin', 'Perempuan')->count();
    $totalPHDP = $peserta->sum('phdp');

    $phdpPerJabatan = $peserta->groupBy('jabatan')->map(function ($group) {
        return round($group->avg('phdp'), 2);
    })->toArray();

    $totalJabatan = $peserta->pluck('jabatan')->unique()->count();

    $adminData = [
        'name' => 'Admin Utama',
        'role' => 'Super Administrator',
        'notifications' => 3
    ];

    $jumlahPerJabatan = Peserta::select('jabatan', \DB::raw('count(*) as total'))
        ->groupBy('jabatan')
        ->pluck('total', 'jabatan')
        ->toArray();

    $data = HistoriIuranPeserta::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->get();

    // Grafik RATA-RATA per bulan sepanjang tahun
    $avgPerMonth = HistoriIuranPeserta::select(
            'bulan',
            \DB::raw('AVG(phdp_bulan_ini) as avg_phdp'),
            \DB::raw('AVG(saldo_akhir_peserta) as avg_saldo_peserta'),
            \DB::raw('AVG(saldo_akhir_pemberi_kerja) as avg_saldo_pemberi')
        )
        ->where('tahun', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get()
        ->map(function ($row) {
            return [
                'bulan' => DateTime::createFromFormat('!m', $row->bulan)->format('F'),
                'phdp' => round($row->avg_phdp, 2),
                'saldo_peserta' => round($row->avg_saldo_peserta, 2),
                'saldo_pemberi' => round($row->avg_saldo_pemberi, 2),
            ];
        });

    return view('supervisor.laporan', compact(
        'data',
        'bulan',
        'tahun',
        'peserta',
        'totalPeserta',
        'totalLaki',
        'totalPerempuan',
        'phdpPerJabatan',
        'totalPHDP',
        'adminData',
        'jumlahPerJabatan',
        'totalJabatan',
        'avgPerMonth'
    ));
}

}