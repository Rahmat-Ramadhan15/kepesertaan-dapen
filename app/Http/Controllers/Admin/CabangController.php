<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabangs = Cabang::all();
        return view('admin.cabang.index', compact('cabangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Cabang::create($request->only(['nama_cabang', 'alamat']));
        return redirect()->back()->with('success', 'Cabang berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('admin.cabang.edit', compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $cabang = Cabang::findOrFail($id);
        $cabang->update($request->only(['nama_cabang', 'alamat']));
        return redirect()->back()->with('success', 'Cabang berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();
        return redirect()->back()->with('success', 'Cabang berhasil dihapus');
    }
}
