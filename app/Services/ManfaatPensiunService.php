<?php

namespace App\Services;

use App\Models\Peserta;
use Carbon\Carbon;

class ManfaatPensiunService
{
    public function hitung(Peserta $peserta, $jenis, $metode, $kenaikan)
{
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

    
    $masaKerja = round($tmk->diffInDays($tanggalBerhenti) / 365, 6);    
    $phdp = $peserta->phdp;
    $mp = 2.5 * $masaKerja * $phdp;
    $maksimum = 0.8 * $phdp;
    $total = $mp + $kenaikan;
    $hasil = 0;

    if ($jenis === 'normal' && $metode === 'bulanan') {
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    if ($jenis === 'normal' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    if ($jenis === 'dipercepat' && $metode === 'bulanan') {
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    if ($jenis === 'normal' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    if ($jenis === 'cacat' && $metode === 'bulanan') {
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    if ($jenis === 'cacat' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    if ($jenis === 'janda/duda' && $metode === 'bulanan') {
        $mp = 0.75 * 2.5 * $masaKerja * $phdp;
        $total = $mp + $kenaikan;
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    if ($jenis === 'anak' && $metode === 'bulanan') {
        $mp = 0.75 * 2.5 * $masaKerja * $phdp;
        $total = $mp + $kenaikan;
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

    if ($jenis === 'anak' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    if ($jenis === 'pihakyangditunjuk' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    if ($jenis === 'ditunda' && $metode === 'bulanan') {
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia', 'jenis', 'metode', 'total');
    }

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
        'total'    => $total,
    ];

    }
}
