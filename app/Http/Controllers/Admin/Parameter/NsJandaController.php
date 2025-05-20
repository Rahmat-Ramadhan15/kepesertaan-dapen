<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\NsJanda;
use Illuminate\Http\Request;

class NsJandaController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $data = NsJanda::all();
    return view('admin.parameter.nsjanda.index', compact('data'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('admin.parameter.nsjanda.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_anak' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    NsJanda::create($validated);
    return redirect()->route('admin.parameter.nsjanda.index')->with('success', 'Data berhasil ditambahkan');
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
    $data = NsJanda::findOrFail($id);
    return view('admin.parameter.nsjanda.edit', compact('data'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'usia' => ['required', 'integer'],
        'nilai_sekarang' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
        'ns_anak' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,6})?$/'],
    ]);

    $NSJanda = NsJanda::findOrFail($id);
    $NSJanda->update($validated);
    return redirect()->route('admin.parameter.nsjanda.index')->with('success', 'Data berhasil diperbarui');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $NSJanda = NsJanda::findOrFail($id);
    $NSJanda->delete();
    return redirect()->route('admin.parameter.nsjanda.index')->with('success', 'Data berhasil dihapus');
}
}
