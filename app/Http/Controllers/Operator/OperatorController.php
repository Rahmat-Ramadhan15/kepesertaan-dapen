<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Cabang;
use App\Models\KodePeserta;
use App\Models\ptkp;
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
            $query->where('kode_cabang', $request->cabang);
        }        

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $peserta = $query->paginate(10)->appends($request->query());

        // Ambil list cabang unik untuk dropdown
        $listCabang = Cabang::all();

        return view('operator.dashboard', compact('peserta','listCabang'));
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
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:50|unique:tablepeserta,nip',
            'nama' => 'required|string|max:255',
            // 'no_sk' => 'string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'usia' => 'required|integer|min:0',
            'tmk' => 'required|date',
            'mkmk' => 'required|string|max:50',
            'tpst' => 'required|date',
            'mkmp' => 'required|date',
            'kode_peserta' => 'required|string|max:50',
            'status_kawin' => 'required|string|max:50',
            'kode_ptkp' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten_kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:20',
            'telpon' => 'required|string|max:20',
            'pendidikan' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'golongan' => 'required|string|max:50',
            'kode_dir' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'tahun_jabat' => 'required|date',
            'phdp' => 'required|numeric|min:0',
            'akumulasi_ibhp' => 'required|numeric|min:0',
            'kode_cabang' => 'required|exists:tablecabang,kode_cabang',
        ], [
            'required' => ':attribute wajib diisi.',
            // 'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah digunakan.',
            'in' => ':attribute tidak valid.',
            'date' => ':attribute harus berupa tanggal yang benar.',
            'integer' => ':attribute harus berupa angka bulat.',
            'numeric' => ':attribute harus berupa angka.',
            'exists' => ':attribute tidak ditemukan dalam database.',
        ]);

        $validator->setAttributeNames([
            'nip' => 'NIP',
            'nama' => 'Nama Lengkap',
            'no_sk' => 'Nomor SK',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'usia' => 'Usia',
            'tmk' => 'Tanggal Masuk Kerja',
            'mkmk' => 'MKMK',
            'tpst' => 'TPST',
            'mkmp' => 'MKMP',
            'kode_peserta' => 'Kode Peserta',
            'status_kawin' => 'Status Kawin',
            'kode_ptkp' => 'Kode PTKP',
            'alamat' => 'Alamat',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kabupaten_kota' => 'Kabupaten/Kota',
            'kode_pos' => 'Kode Pos',
            'telpon' => 'Nomor Telepon',
            'pendidikan' => 'Pendidikan',
            'jurusan' => 'Jurusan',
            'golongan' => 'Golongan',
            'kode_dir' => 'Kode Direktorat',
            'jabatan' => 'Jabatan',
            'tahun_jabat' => 'Tahun Menjabat',
            'phdp' => 'PhDP',
            'akumulasi_ibhp' => 'Akumulasi IBHP',
            'kode_cabang' => 'Kode Cabang',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        if ($request->has('cabang') && !$request->has('kode_cabang')) {
            $input['kode_cabang'] = $request->input('cabang');
        }

        Peserta::create($input);

        return redirect()->route('operator.index')->with('success', 'Peserta berhasil ditambahkan.');
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
        $kdpeserta = KodePeserta::all();
        $kdptkp = ptkp::all();
        return view('operator.edit', compact('peserta','cabangs','kdpeserta','kdptkp'));
    }

    public function update(Request $request, $nip)
    {
        // dd($request->all());
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        $peserta->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');

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