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
        $usiaBulat = floor($usia);
        $a = null; $b = null; $c = null;
        $f = null; $g = null;

        if (
            ($jenis === 'dipercepat' || $jenis === 'janda/duda' || $jenis === 'anak' || $jenis === 'ditunda' || $jenis === 'cacat') 
            && $metode === 'bulanan'
        ) {
            // Jenis khusus dan metode bulanan → pakai NilaiSekarang
            $ns = NilaiSekarang::where('usia', $usiaBulat)->value('nilai_sekarang');
        } elseif (
            in_array($jenis, ['dipercepat', 'ditunda', 'cacat']) &&
            $metode === 'sekaligus'
        ) {
            $a = NsPegawai::where('usia', $usiaBulat)->value('nilai_sekarang');
            $b = NsPegawai::where('usia', $usiaBulat)->value('ns_janda');
            $c = NsPegawai::where('usia', $usiaBulat)->value('ns_anak');

            if (is_null($a) || is_null($b) || is_null($c)) {
                return ['error' => "Nilai Sekarang tidak ditemukan untuk usia $usiaBulat pada jenis $jenis."];
            }
        } elseif (
            $jenis === 'janda/duda' && $metode === 'sekaligus'
        ) {
            $f = NsJanda::where('usia', $usiaBulat)->value('nilai_sekarang');
            $g = NsJanda::where('usia', $usiaBulat)->value('ns_anak');

            if (is_null($f) || is_null($g)) {
                return ['error' => "Nilai Sekarang tidak ditemukan untuk usia $usiaBulat pada jenis $jenis."];
            }
        } else {
            $ns = null;
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

        // Variabel universal
        $mp = 0;
        $maksimum = 0.8 * $phdp;

        // Variabel perhitungan mp 100% sekaligus
        $pp = 0.025 * $masaKerja * $phdp;
        $pj = 0.75 * $pp;
        $pa = 0.75 * $pp;

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
                    $mp = 0.75 * 0.025 * $masaKerja * $phdp;
                }
            } elseif (in_array($jenis, ['dipercepat', 'cacat', 'ditunda']) && $metode === 'sekaligus') {
                $mp = ($a * $pp) + ($b * $pj) + ($c * $pa);
            } elseif ($jenis === 'janda/duda' && $metode === 'sekaligus') {
                $mp = ($f * $pj) + ($g * $pa);
            } else {
                $mp = 0;
                logger()->info('MP tidak dihitung: kombinasi tidak cocok', compact('kodeDirektorat', 'jenis', 'metode'));
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
            'hasil'     => $mp,
            'usia'      => $usia,
            'jenis'     => $jenis,
            'metode'    => $metode,
            'total'     => $mp,
            'kodeDirektorat' => $kodeDirektorat,
            'statusMeninggal' => $statusMeninggal,
            'pp'        => $pp,
            'pj'        => $pj,
            'pa'        => $pa,
            'a'         => $a,
            'b'         => $b,
            'c'         => $c,
            'f'         => $f,
            'g'         => $g,
        ];
    }

}
