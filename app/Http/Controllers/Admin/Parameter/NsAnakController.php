<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\NsAnak;
use Illuminate\Http\Request;

class NsAnakController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $data = NsAnak::all();
    return view('admin.parameter.nsanak.index', compact('data'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('admin.parameter.nsanak.create');
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

    NsAnak::create($validated);
    return redirect()->route('admin.parameter.nsanak.index')->with('success', 'Data berhasil ditambahkan');
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
    $data = NsAnak::findOrFail($id);
    return view('admin.parameter.nsanak.edit', compact('data'));
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

    $NSAnak = NsAnak::findOrFail($id);
    $NSAnak->update($validated);
    return redirect()->route('admin.parameter.nsanak.index')->with('success', 'Data berhasil diperbarui');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $NSAnak = NsAnak::findOrFail($id);
    $NSAnak->delete();
    return redirect()->route('admin.parameter.nsanak.index')->with('success', 'Data berhasil dihapus');
}
}
