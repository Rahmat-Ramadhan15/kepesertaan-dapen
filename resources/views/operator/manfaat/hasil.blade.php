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
    <div class="value"><span class="label">Kenaikan:</span> Rp{{ number_format($hasil['kenaikan'], 0, ',', '.') }}
    </div>

    <br>
    <h3>Perhitungan Manfaat Pensiun</h3>
    <hr>

    @php
        $rumus = '';

        if ($hasil['jenis'] === 'janda/duda' && $hasil['metode'] === 'bulanan') {
            $rumus = '0.75 × 2.5 × Masa Kerja × PhDP + Kenaikan';
        } elseif ($hasil['jenis'] === 'anak' && $hasil['metode'] === 'bulanan') {
            $rumus = '0.75 × 2.5 × Masa Kerja × PhDP + Kenaikan';
        } elseif (
            in_array($hasil['jenis'], ['normal', 'dipercepat', 'cacat', 'ditunda']) &&
            $hasil['metode'] === 'bulanan'
        ) {
            $rumus = '0.025 × Masa Kerja × PhDP + Kenaikan';
        } elseif ($hasil['metode'] === 'sekaligus') {
            $rumus = 'Manfaat Pensiun × 12 bulan';
        } else {
            $rumus = 'Tidak tersedia';
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
