<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Ptkp;
use Illuminate\Http\Request;

class PtkpController extends Controller
{
    public function index()
    {
        $data = Ptkp::all();
        return view('admin.parameter.ptkp.index', compact('data'));
    }

    public function create()
    {
        return view('admin.parameter.ptkp.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ptkp' => 'required|string|max:20',
            'nilai_ptkp' => 'required|numeric|min:0',
        ]);

        Ptkp::create($validated);
        return redirect()->route('admin.parameter.ptkp.index')->with('success', 'Data PTKP berhasil ditambahkan');
    }

    public function edit(string $kode_ptkp)
    {
        $data = Ptkp::findOrFail($kode_ptkp);
        return view('admin.parameter.ptkp.edit', compact('data'));
    }

    public function update(Request $request, string $kode_ptkp)
    {
        $validated = $request->validate([
            'kode_ptkp' => 'required|string|max:20',
            'nilai_ptkp' => 'required|numeric|min:0',
        ]);

        $ptkp = Ptkp::findOrFail($kode_ptkp);
        $ptkp->update($validated);
        return redirect()->route('admin.parameter.ptkp.index')->with('success', 'Data PTKP berhasil diperbarui');
    }

    public function destroy(string $kode_ptkp)
    {
        $ptkp = Ptkp::findOrFail($kode_ptkp);
        $ptkp->delete();
        return redirect()->route('admin.parameter.ptkp.index')->with('success', 'Data PTKP berhasil dihapus');
    }
}
