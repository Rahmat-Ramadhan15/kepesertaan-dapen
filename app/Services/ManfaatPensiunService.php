<?php

namespace App\Services;

use App\Models\Peserta;
use Carbon\Carbon;

class ManfaatPensiunService
{
    public function hitung(Peserta $peserta, $jenis, $metode, $kenaikan)
{
    $kodeDirektorat = strtolower($peserta->kode_direktorat);
    $tanggalLahir = Carbon::make($peserta->tanggal_lahir);
    $tanggalBerhenti = $peserta->tpst ? Carbon::make($peserta->tpst) : now();
    $usia = $tanggalLahir->diffInYears($tanggalBerhenti);
    $tmk = Carbon::make($peserta->tmk);

    // Validasi usia
    if ($jenis === 'normal' && $usia < 55) {
        return ['error' => 'Usia belum memenuhi syarat pensiun normal (minimal 55 tahun).'];
    }

    if ($jenis === 'dipercepat' && $usia < 45) {
        return ['error' => 'Usia belum memenuhi syarat pensiun dipercepat (minimal 45 tahun).'];
    }

    $diff = $tmk->diff($tanggalBerhenti);
    $tahun = $diff->y;
    $bulan = $diff->m;
    $hari = $diff->d;
    if ($hari >= 15) {
        $bulan += 1;
    }
    $masaKerja = $tahun + ($bulan / 12);
    $phdp = $peserta->phdp;

    // Inisialisasi variabel
    $mp = 2.5 * $masaKerja * $phdp;
    $maksimum = 0.8 * $phdp;
    $total = $mp + $kenaikan;
    $hasil = 0;

    // ==== 1. LOGIKA UNTUK DIREKSI ====
    if ($kodeDirektorat === 'direksi') {
        if ($jenis === 'normal' && $metode === 'bulanan') {
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'normal' && $metode === 'sekaligus') {
            $hasil = $mp * 12;
        } elseif ($jenis === 'dipercepat' && $metode === 'bulanan') {
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'dipercepat' && $metode === 'sekaligus') {
            $hasil = $mp * 12;
        } elseif ($jenis === 'cacat' && $metode === 'bulanan') {
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'cacat' && $metode === 'sekaligus') {
            $hasil = $mp * 12;
        } elseif ($jenis === 'janda/duda' && $metode === 'bulanan') {
            $mp = 0.75 * 2.5 * $masaKerja * $phdp;
            $total = $mp + $kenaikan;
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'anak' && $metode === 'bulanan') {
            $mp = 0.75 * 2.5 * $masaKerja * $phdp;
            $total = $mp + $kenaikan;
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'anak' && $metode === 'sekaligus') {
            $hasil = $mp * 12;
        } elseif ($jenis === 'pihakyangditunjuk' && $metode === 'sekaligus') {
            $hasil = $mp * 12;
        } elseif ($jenis === 'ditunda' && $metode === 'bulanan') {
            $hasil = min($total, $maksimum);
        }

        return compact('masaKerja', 'phdp', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    // ==== 2. LOGIKA UNTUK KARYAWAN ====
    if ($kodeDirektorat === 'karyawan') {
        // Simulasi 3 variasi rumus untuk karyawan:
        if ($jenis === 'normal' && $metode === 'bulanan') {
            // VARIASI 1
            $mp = 2.0 * $masaKerja * $phdp;
            $maksimum = 0.75 * $phdp;
            $total = $mp + $kenaikan;
            $hasil = min($total, $maksimum);
        } elseif ($jenis === 'normal' && $metode === 'sekaligus') {
            // VARIASI 2
            $mp = 2.5 * $masaKerja * $phdp;
            $hasil = $mp * 10; // bukan 12 bulan, hanya 10
        } elseif ($jenis === 'dipercepat' && $metode === 'bulanan') {
            // VARIASI 3
            $mp = 2.3 * $masaKerja * $phdp;
            $maksimum = 0.7 * $phdp;
            $total = $mp + $kenaikan;
            $hasil = min($total, $maksimum);
        } else {
            // default fallback untuk jenis lainnya
            $hasil = min($total, $maksimum);
        }

        return compact('masaKerja', 'phdp', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    // ==== 3. DEFAULT UNTUK YANG LAIN ====
    return [
        'masaKerja' => $masaKerja,
        'phdp'      => $phdp,
        'mp'        => $mp,
        'kenaikan'  => $kenaikan,
        'maksimum'  => $metode === 'bulanan' ? $maksimum : null,
        'hasil'     => $hasil,
        'usia'      => $usia,
        'jenis'     => $jenis,
        'metode'    => $metode,
        'total'     => $total,
    ];
}

}
