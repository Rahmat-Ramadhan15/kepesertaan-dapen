<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = DataBank::all(); // Mengambil semua data dari tabel tablebank
        return view('admin.parameter.databank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parameter.databank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input untuk penambahan baru
        $request->validate([
            'kode_bank' => 'required|string|max:255',
            'nama_bank' => 'required|string|max:255',
            // Aturan unique untuk kode_cabang (primary key) tanpa pengecualian ID
            'kode_cabang' => 'required|string|max:255|unique:tablebank,kode_cabang',
            'nama_cabang' => 'required|string|max:255',
            'kode_full' => 'required|string|max:255|unique:tablebank,kode_full',
            'alamat' => 'nullable|string|max:255',
        ]);

        DataBank::create($request->all());

        return redirect()->route('admin.parameter.databank.index')->with('success', 'Data Bank berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataBank $databank) // Laravel akan mencari berdasarkan kode_cabang
    {
        return view('admin.parameter.databank.edit', compact('databank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataBank $databank) // Laravel akan mencari berdasarkan kode_cabang
    {
        // Validasi data input untuk pembaruan
        $request->validate([
            'kode_bank' => 'required|string|max:255',
            'nama_bank' => 'required|string|max:255',
            // Aturan unique untuk kode_cabang (primary key)
            // Abaikan record yang sedang diedit berdasarkan primary key-nya (kode_cabang)
            'kode_cabang' => "required|string|max:255|unique:tablebank,kode_cabang,{$databank->kode_cabang},kode_cabang",
            'nama_cabang' => 'required|string|max:255',
            // Aturan unique untuk kode_full
            // Abaikan record yang sedang diedit berdasarkan primary key-nya (kode_cabang)
            'kode_full' => "required|string|max:255|unique:tablebank,kode_full,{$databank->kode_cabang},kode_cabang",
            'alamat' => 'nullable|string|max:255',
        ]);

        $databank->update($request->all());

        return redirect()->route('admin.parameter.databank.index')->with('success', 'Data Bank berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataBank $databank) // Laravel akan mencari berdasarkan kode_cabang
    {
        try {
            $databank->delete(); // Eloquent akan menghapus berdasarkan primaryKey yang didefinisikan
            return redirect()->route('admin.parameter.databank.index')->with('success', 'Data Bank berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting DataBank: ' . $e->getMessage());
            return redirect()->route('admin.parameter.databank.index')->with('error', 'Gagal menghapus Data Bank. Terjadi kesalahan.');
        }
    }
}