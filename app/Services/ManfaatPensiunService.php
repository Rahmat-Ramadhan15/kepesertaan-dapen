<?php

namespace App\Services;

use App\Models\Peserta;
use App\Models\NilaiSekarang;
use App\Models\NsPegawai;
use App\Models\NsJanda;
use App\Models\NsAnak;
use Carbon\Carbon;

class ManfaatPensiunService
{
    public function hitung(Peserta $peserta, $jenis, $metode, $kenaikan, $statusMeninggal = null, $usia)
    {
        $kodeDirektorat = strtolower($peserta->kode_dir);
        $tanggalLahir = Carbon::make($peserta->tanggal_lahir);
        $tanggalBerhenti = $peserta->tpst ? Carbon::make($peserta->tpst) : now();
        $tmk = Carbon::make($peserta->tmk);

        // Hitung usia saat berhenti
        $usia = $tanggalLahir->diffInYears($tanggalBerhenti);

        // Validasi usia
        if ($jenis === 'normal' && $usia < 55) {
            return ['error' => 'Usia belum memenuhi syarat pensiun normal (minimal 55 tahun).'];
        }

        if ($jenis === 'dipercepat' && $usia < 45) {
            return ['error' => 'Usia belum memenuhi syarat pensiun dipercepat (minimal 45 tahun).'];
        }

        // Logika request data NS berdasarkan jenis pensiun
        if (
            ($jenis === 'dipercepat' || $jenis === 'janda/duda' || $jenis === 'anak' || $jenis === 'ditunda' || $jenis === 'cacat') 
            && $metode === 'bulanan'
        ) {
            // Jenis khusus dan metode bulanan → pakai NilaiSekarang
            $ns = NilaiSekarang::where('usia', $usia)->value('nilai_sekarang');

        } else {
            // Jenis lain (termasuk normal atau sekaligus) tidak pakai Nilai Sekarang
            $ns = null;
        }

        if (is_null($ns) && in_array($jenis, ['dipercepat', 'janda/duda', 'anak', 'ditunda', 'cacat']) && $metode === 'bulanan') {
            return ['error' => "Nilai Sekarang tidak ditemukan untuk usia $usia dan jenis $jenis."];
        }

        // Hitung masa kerja dari tmk ke tpst (atau now)
        $diff = $tmk->diff($tanggalBerhenti);
        $tahun = $diff->y;
        $bulan = $diff->m;
        $hari = $diff->d;

        // Jika hari >= 15 maka dihitung 1 bulan
        if ($hari >= 15) {
            $bulan += 1;
        }

        // Konversi masa kerja ke desimal (tahun)
        $masaKerja = $tahun + ($bulan / 12);
        $phdp = $peserta->phdp;

        $mp = 0;
        $total = 0;
        $maksimum = 0.8 * $phdp;

        // Rumus Pegawai / Karyawan
        if ($kodeDirektorat === 'karyawan') {
            if ($jenis === 'normal' && $metode === 'bulanan') {
                $mp = 0.025 * $masaKerja * $phdp + $kenaikan;
            } elseif (in_array($jenis, ['dipercepat', 'cacat', 'ditunda']) && $metode === 'bulanan') {
                $mp = 0.025 * $ns * $masaKerja * $phdp + $kenaikan;
            } elseif (in_array($jenis, ['janda/duda', 'anak']) && $metode === 'bulanan') {
                if ($statusMeninggal === 'aktif') {
                    $mp = 0.75 * $ns * 0.025 * $masaKerja * $phdp + $kenaikan;
                } elseif ($statusMeninggal === 'pensiun') {
                    $mp = 0.75 * 0.025 * $masaKerja * $phdp; // atau ambil dari MP pensiunan
                }
            }
        }


        // Rumus Direksi
        if ($kodeDirektorat === 'direktur') {
            if (in_array($jenis, ['normal', 'dipercepat', 'cacat', 'ditunda']) && $metode === 'bulanan') {
                $mp = 0.025 * $masaKerja * $phdp;
            } elseif (in_array($jenis, ['janda/duda', 'anak']) && $metode === 'bulanan') {
                if ($statusMeninggal === 'aktif') {
                    $mp = 0.75 * 0.025 * $masaKerja * $phdp;
                } elseif ($statusMeninggal === 'pensiun') {
                    $mp = 0.75 * 0.025 * $masaKerja * $phdp;
                }
            } 
        }

        return [
            'masaKerja' => $masaKerja,
            'phdp'      => $phdp,
            'mp'        => $mp,
            'kenaikan'  => $kenaikan,
            'maksimum'  => $metode === 'bulanan' ? $maksimum : null,
            'hasil'     => $total,
            'usia'      => $usia,
            'jenis'     => $jenis,
            'metode'    => $metode,
            'total'     => $total,
        ];
    }

}
