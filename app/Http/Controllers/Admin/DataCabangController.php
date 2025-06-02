<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang; // <<< Ubah import model
use App\Models\DataBank; // PASTIKAN BARIS INI ADA DAN TIDAK ADA TYPO
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataCabangController extends Controller // <<< Ubah nama kelas controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Cabangs = Cabang::all(); // <<< Ubah nama variabel dan model
        return view('admin.cabang.index', compact('Cabangs')); // <<< Ubah nama variabel compact
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua kode_cabang, nama_cabang, dan alamat dari tablebank
        // Data ini akan digunakan untuk dropdown dan pengisian otomatis
        $bank_data = DataBank::select('kode_cabang', 'nama_cabang', 'alamat')->get();

        return view('admin.cabang.create', compact('bank_data')); // Meneruskan data ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_cabang' => 'required|string|max:255|unique:tablecabang,kode_cabang',
            'nama_cabang' => 'required|string|max:255',
            'kode_alias' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'telepon' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
        ]);

        Cabang::create($request->all());

        return redirect()->route('cabang.index')->with('success', 'Data Cabang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_cabang)
    {
        // Jika Anda butuh metode ini, pastikan menggunakan Cabang
        // $Cabang = Cabang::where('kode_cabang', $kode_cabang)->firstOrFail();
        // return view('admin.cabang.show', compact('Cabang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang) // <<< Ubah tipe hint dan nama variabel
    {
        return view('admin.cabang.edit', compact('cabang')); // <<< Ubah nama variabel compact
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang) // <<< Ubah tipe hint dan nama variabel
    {
        $request->validate([
            'kode_cabang' => "required|string|max:255|unique:tablecabang,kode_cabang,{$cabang->kode_cabang},kode_cabang",
            'nama_cabang' => 'required|string|max:255',
            'kode_alias' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'telepon' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
        ]);

        $cabang->update($request->all()); // <<< Ubah variabel

        return redirect()->route('cabang.index')->with('success', 'Data Cabang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Cabang $cabang) // Laravel akan mencari berdasarkan kode_cabang
    {
        

        try {
            // ... (kode yang sudah ada untuk pengecekan if (!$Cabang->exists))
            if (!$cabang->exists) {
                Log::warning('Data Cabang model instance not found for deletion: ' . $cabang->kode_cabang);
                return redirect()->route('cabang.index')->with('error', 'Gagal menghapus. Data Cabang tidak ditemukan di database.');
            }

            $deleted = $cabang->delete();

            if ($deleted) {
                Log::info('Successfully deleted Data Cabang with KODE_CABANG: ' . $cabang->kode_cabang);
                return redirect()->route('cabang.index')->with('success', 'Data Cabang berhasil dihapus!');
            } else {
                Log::warning('Failed to delete Data Cabang with KODE_CABANG: ' . $cabang->kode_cabang . ' - delete() returned false (no rows affected).');
                return redirect()->route('cabang.index')->with('error', 'Gagal menghapus Data Cabang. Tidak ada data yang terpengaruh di database.');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Data Cabang (exception caught): ' . $e->getMessage() . ' for KODE_CABANG: ' . ($cabang->kode_cabang ?? 'N/A'));
            return redirect()->route('cabang.index')->with('error', 'Gagal menghapus Data Cabang. Terjadi kesalahan server: ' . $e->getMessage());
        }
    }
}