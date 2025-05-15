<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\NilaiSekarang;
use Illuminate\Http\Request;

class NilaiSekarangController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $data = NilaiSekarang::all();
    return view('admin.parameter.ns.index', compact('data'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('admin.parameter.ns.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    NilaiSekarang::create($validated);
    return redirect()->route('admin.parameter.ns.index')->with('success', 'Data berhasil ditambahkan');
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
    $data = NilaiSekarang::findOrFail($id);
    return view('admin.parameter.ns.edit', compact('data'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    $nilaiSekarang = NilaiSekarang::findOrFail($id);
    $nilaiSekarang->update($validated);
    return redirect()->route('admin.parameter.ns.index')->with('success', 'Data berhasil diperbarui');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $nilaiSekarang = NilaiSekarang::findOrFail($id);
    $nilaiSekarang->delete();
    return redirect()->route('admin.parameter.ns.index')->with('success', 'Data berhasil dihapus');
}
}
