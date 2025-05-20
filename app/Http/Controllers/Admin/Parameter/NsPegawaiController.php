<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\NsPegawai;
use Illuminate\Http\Request;

class NsPegawaiController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $data = NsPegawai::all();
    return view('admin.parameter.nspegawai.index', compact('data'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('admin.parameter.nspegawai.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_janda' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_anak' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    NsPegawai::create($validated);
    return redirect()->route('admin.parameter.nspegawai.index')->with('success', 'Data berhasil ditambahkan');
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
    $data = NsPegawai::findOrFail($id);
    return view('admin.parameter.nspegawai.edit', compact('data'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_janda' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_anak' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    $NSPegawai = NsPegawai::findOrFail($id);
    $NSPegawai->update($validated);
    return redirect()->route('admin.parameter.nspegawai.index')->with('success', 'Data berhasil diperbarui');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $NSPegawai = NsPegawai::findOrFail($id);
    $NSPegawai->delete();
    return redirect()->route('admin.parameter.nspegawai.index')->with('success', 'Data berhasil dihapus');
}
}
