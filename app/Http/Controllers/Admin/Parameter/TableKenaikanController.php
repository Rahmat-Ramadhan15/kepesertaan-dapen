<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\TableKenaikan;
use Illuminate\Http\Request;

class TableKenaikanController extends Controller
{
    public function index()
    {
        $kenaikan = TableKenaikan::all();
        return view('admin.parameter.kenaikan.index', compact('kenaikan'));
    }

        public function create()
    {
        return view('admin.parameter.kenaikan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => ['required', 'string'],
            'kenaikan' => ['required', 'integer'],
        ]);

        TableKenaikan::create($validated);
        return redirect()->route('admin.parameter.kenaikan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $kenaikan = TableKenaikan::findOrFail($id);
        return view('admin.parameter.kenaikan.edit', compact('kenaikan'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'jabatan' => ['required', 'string'],
            'kenaikan' => ['required', 'integer'],
        ]);

        $nilai_kenaikan = TableKenaikan::findOrFail($id);
        $nilai_kenaikan->update($validated);
        return redirect()->route('admin.parameter.kenaikan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $nilai_kenaikan = TableKenaikan::findOrFail($id);
        $nilai_kenaikan->delete();
        return redirect()->route('admin.parameter.kenaikan.index')->with('success', 'Data berhasil dihapus');
    }
}
