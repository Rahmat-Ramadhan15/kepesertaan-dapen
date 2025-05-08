<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Cabang;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peserta::query();

        if ($request->filled('cabang')) {
            $query->where('cabang_id', $request->cabang);
        }        

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $peserta = $query->get();

        // Ambil list cabang unik untuk dropdown
        $listCabang = Cabang::all();

        return view('operator.dashboard', compact('peserta', 'listCabang'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listCabang = Cabang::all();
        return view('operator.create', compact('listCabang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:pesertas,nip|max:50',
            'nama' => 'required|string|max:255',
            'no_sk' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'tmk' => 'nullable|date',
            'tpst' => 'nullable|date',
            'kode_peserta' => 'nullable|string|max:50',
            'status_pernikahan' => 'nullable|string|max:50',
            'kode_ptkp' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:20',
            'telpon' => 'nullable|string|max:20',
            'cabang_id' => 'nullable|exists:cabangs,id',
            'pendidikan' => 'nullable|string|max:100',
            'jurusan' => 'nullable|string|max:100',
            'golongan' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'phdp' => 'nullable|numeric',
            'akumulasi_ibhp' => 'nullable|numeric',
        ]);


        // Create new Peserta record
        try {
            // Create a new input array with the correct field mapping
            $input = $request->all();
            
            // Handle the cabang to cabang_id mapping if needed
            if ($request->has('cabang') && !$request->has('cabang_id')) {
                $input['cabang_id'] = $request->cabang;
            }
            
            $peserta = Peserta::create($input);
            return redirect()->route('operator.index')
                ->with('success', 'Peserta berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail($nip)
    {
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        $keluarga =  Peserta::with('keluargas')->where('nip', $nip)->firstOrFail();
        return view('operator.detail', compact('peserta','keluarga'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nip)
    {
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        $cabangs = Cabang::all();
        return view('operator.edit', compact('peserta','cabangs'));
    }

    public function update(Request $request, $nip)
    {
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        $peserta->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        try {
            $peserta = Peserta::findOrFail($nip);
            $peserta->delete();

            return redirect()->route('operator.index')
                ->with('success', 'Peserta berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}