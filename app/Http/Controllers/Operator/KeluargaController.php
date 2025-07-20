<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga; // Pastikan model ini ada
use App\Models\Peserta; // Jika ingin relasi ke peserta

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluargas = Keluarga::all();
        return view('keluarga.index', compact('keluargas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($nip)
    {
        $peserta = Peserta::where('nip', $nip)->firstOrFail();
        return view('operator.keluarga.create', compact('peserta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|exists:tablepeserta,nip',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'hubungan' => 'required|in:Suami,Istri,Anak,Pihak YDT',
            'usia' => 'required|integer|min:0',
            'anak_ke' => 'nullable|integer|min:1',
            'tanggal_nikah' => 'nullable|date',
            'status_ahli_waris' => 'nullable|in:Kawin,Meninggal,Sekolah,Lain-lain',
            'keterangan' => 'nullable|in:Berhak,Tidak Berhak',
        ], [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak ditemukan di database.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'in' => ':attribute harus salah satu dari: :values.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'numeric' => ':attribute harus berupa angka.',
            'integer' => ':attribute harus berupa bilangan bulat.',
            'min' => ':attribute minimal bernilai :min.',
        ], [
            'nip' => 'NIP Peserta',
            'nama' => 'Nama Keluarga',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'hubungan' => 'Hubungan Keluarga',
            'usia' => 'Usia',
            'anak_ke' => 'Anak Ke',
            'tanggal_nikah' => 'Tanggal Nikah',
            'status_ahli_waris' => 'Status Ahli Waris',
            'keterangan' => 'Keterangan',
        ]);

        $data = $request->all();

        // Kosongkan tanggal nikah jika hubungan bukan Suami/Istri
        if (!in_array($data['hubungan'], ['Suami', 'Istri'])) {
            $data['tanggal_nikah'] = null;
        }

        Keluarga::create($data);

        return redirect()->back()->with('success', 'Data keluarga berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Keluarga $keluarga)
    {
        return view('keluarga.show', compact('keluarga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluarga $keluarga)
    {
        return view('keluarga.edit', compact('keluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'hubungan' => 'required|in:Suami,Istri,Anak,Pihak YDT',
            'usia' => 'required|integer|min:0',
            'anak_ke' => 'nullable|integer|min:1',
            'tanggal_nikah' => 'nullable|date',
            'status_ahli_waris' => 'nullable|in:Kawin,Meninggal,Sekolah,Lain-lain',
            'keterangan' => 'nullable|in:Berhak,Tidak Berhak',
        ]);

        $data = $request->all();

        // Kosongkan tanggal nikah jika hubungan bukan Suami/Istri
        if (!in_array($data['hubungan'], ['Suami', 'Istri'])) {
            $data['tanggal_nikah'] = null;
        }

        $keluarga->update($data);

        return redirect()->back()->with('success', 'Data keluarga diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->back()->with('success', 'Data keluarga dihapus');
    }
}
