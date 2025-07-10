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

    if ($jenis === 'normal' && $metode === 'bulanan') {
        $hasil = min($total, $maksimum);
        return compact('masaKerja', 'mp', 'kenaikan', 'maksimum', 'hasil', 'usia');
    }

    if ($jenis === 'normal' && $metode === 'sekaligus') {
        $hasil = $mp * 12;
        return compact('masaKerja', 'mp', 'hasil', 'kenaikan', 'usia');
    }

    return ['masaKerja' => $masaKerja, 'mp' => 0, 'kenaikan' => 0, 'maksimum' => null, 'hasil' => 0, 'usia' => $usia];
    }
}
