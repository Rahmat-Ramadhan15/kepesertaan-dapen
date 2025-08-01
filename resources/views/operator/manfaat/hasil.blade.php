<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Perhitungan MP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .label {
            font-weight: bold;
        }

        .value {
            margin-bottom: 10px;
        }

        .highlight {
            font-weight: bold;
            color: green;
        }
    </style>
</head>

<body>
    <h2>Hasil Perhitungan Manfaat Pensiun {{ ucfirst($hasil['jenis'] ?? '') }}</h2>

    <br>
    <h3>Data Peserta</h3>
    <hr>
    <div class="value"><span class="label">NIP:</span> {{ $peserta->nip }}</div>
    <div class="value"><span class="label">Nama:</span> {{ $peserta->nama }}</div>
    <div class="value">
        <div class="value"><span class="label">Tanggal Lahir:</span>
            {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d-m-Y') }}</div>
        <span class="label">Usia:</span>
        {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->age }} tahun
    </div>
    <div class="value"><span class="label">Tanggal Masuk:</span>
        {{ \Carbon\Carbon::parse($peserta->tmk)->format('d-m-Y') }}</div>
    <div class="value"><span class="label">Tanggal Berhenti:</span>
        {{ $peserta->tpst ? \Carbon\Carbon::parse($peserta->tpst)->format('d-m-Y') : 'Aktif' }}
    </div>
    <div class="value"><span class="label">Masa Kerja:</span> {{ number_format($hasil['masaKerja'], 6) }} tahun</div>
    <div class="value"><span class="label">PhDP:</span> Rp{{ number_format($peserta->phdp, 0, ',', '.') }}</div>
    @if ($hasil['metode'] === 'bulanan')
        <div class="value">
            <span class="label">Kenaikan:</span> Rp{{ number_format($hasil['kenaikan'], 0, ',', '.') }}
        </div>
    @endif
    </div>

    <br>
    <h3>Perhitungan Manfaat Pensiun</h3>
    <hr>

    @php
        $komponen = [];

        if (in_array($hasil['jenis'], ['dipercepat', 'cacat', 'ditunda']) && $hasil['metode'] === 'sekaligus') {
            $komponen = [
                'pp' => $hasil['pp'] ?? 0,
                'pj' => $hasil['pj'] ?? 0,
                'pa' => $hasil['pa'] ?? 0,
                'a' => $hasil['a'] ?? 0,
                'b' => $hasil['b'] ?? 0,
                'c' => $hasil['c'] ?? 0,
            ];
        } elseif ($hasil['jenis'] === 'janda/duda' && $hasil['metode'] === 'sekaligus') {
            $komponen = [
                'pj' => $hasil['pj'] ?? 0,
                'pa' => $hasil['pa'] ?? 0,
                'f' => $hasil['f'] ?? 0,
                'g' => $hasil['g'] ?? 0,
            ];
        }

        $rupiahFields = ['pp', 'pj', 'pa'];
    @endphp

    @if (!empty($komponen))
        <div class="komponen">
            <strong>Rincian Komponen:</strong>
            <ul>
                @foreach ($komponen as $kode => $nilai)
                    <li>
                        <strong>{{ strtoupper($kode) }}:</strong>
                        @if (in_array($kode, $rupiahFields))
                            Rp{{ number_format($nilai, 0, ',', '.') }}
                        @else
                            {{ number_format($nilai, 0, ',', '.') }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $rumus = '';

        if ($hasil['kodeDirektorat'] === 'karyawan') {
            if ($hasil['jenis'] === 'normal' && $hasil['metode'] === 'bulanan') {
                $rumus = '0.025 × Masa Kerja × PhDP + Kenaikan';
            } elseif (in_array($hasil['jenis'], ['dipercepat', 'cacat', 'ditunda']) && $hasil['metode'] === 'bulanan') {
                $rumus = '0.025 × NS × Masa Kerja × PhDP + Kenaikan';
            } elseif (in_array($hasil['jenis'], ['janda/duda', 'anak']) && $hasil['metode'] === 'bulanan') {
                if ($hasil['statusMeninggal'] === 'aktif') {
                    $rumus = '0.75 × NS × 0.025 × Masa Kerja × PhDP + Kenaikan';
                } elseif ($hasil['statusMeninggal'] === 'pensiun') {
                    $rumus = '0.75 × 0.025 × Masa Kerja × PhDP';
                }
            } elseif (
                in_array($hasil['jenis'], ['dipercepat', 'cacat', 'ditunda']) &&
                $hasil['metode'] === 'sekaligus'
            ) {
                $rumus = '(A × PP) + (B × PJ) + (C × PA)';
            } elseif ($hasil['jenis'] === 'janda/duda' && $hasil['metode'] === 'sekaligus') {
                $rumus = '(F × PJ) + (G × PA)';
            } else {
                $rumus = 'Tidak tersedia';
            }
        } else {
            $rumus = 'Tidak tersedia (bukan karyawan)';
        }
    @endphp


    <div class="value"><span class="label">Rumus Dasar:</span> {{ $rumus }}</div>

    <div class="value">
        <span class="label">PP ({{ ucfirst($hasil['jenis']) }} -
            {{ $hasil['metode'] === 'bulanan' ? 'Bulanan' : 'Sekaligus' }}):</span>
        Rp{{ number_format($hasil['mp'], 0, ',', '.') }}
    </div>
    @if (!is_null($hasil['maksimum']))
        <div class="value"><span class="label">Maksimum (80% dari PhDP):</span>
            Rp{{ number_format($hasil['maksimum'], 0, ',', '.') }}</div>
    @endif

</body>

</html>
