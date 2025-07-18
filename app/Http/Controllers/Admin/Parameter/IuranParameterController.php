<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\IuranParameter;
use Illuminate\Http\Request;

class IuranParameterController extends Controller
{
    public function index()
    {
        $data = IuranParameter::all();
        return view('admin.parameter.parameter_iuran.index', compact('data'));
    }

    public function edit($id)
    {
        $parameter = IuranParameter::findOrFail($id);
        return view('admin.parameter.parameter_iuran.edit', compact('parameter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persentase_peserta' => 'required|numeric|min:0|max:1',
            'persentase_pemberi_kerja' => 'required|numeric|min:0|max:1',
        ]);

        $parameter = IuranParameter::findOrFail($id);
        $parameter->update([
            'persentase_peserta' => $request->persentase_peserta,
            'persentase_pemberi_kerja' => $request->persentase_pemberi_kerja,
        ]);

        return redirect()->route('admin.parameter.parameter_iuran.index')->with('success', 'Data berhasil diperbarui.');
    }
}
