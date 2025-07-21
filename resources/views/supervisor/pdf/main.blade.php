<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard Rekap PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 6px; text-align: left; }
        .title { text-align: center; margin-bottom: 20px; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; }
        footer { text-align: center; margin-top: 40px; font-size: 11px; color: #555; }
    </style>
</head>
<body>

    <div class="title">
        <h2>Rekap Peserta</h2>
        <p>Generated at {{ now()->format('d M Y H:i') }}</p>
    </div>

    <h4>Statistik</h4>
    <ul>
        <li>Total Peserta: {{ $totalPeserta }}</li>
        <li>Laki-laki: {{ $totalLaki }}</li>
        <li>Perempuan: {{ $totalPerempuan }}</li>
        <li>Total PHDP: Rp {{ number_format($totalPHDP, 0, ',', '.') }}</li>
        <li>Total Jabatan: {{ $totalJabatan }}</li>
    </ul>

    <h4>Data Peserta</h4>
    <table class="table">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>PHDP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peserta as $p)
                <tr>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>Rp {{ number_format($p->phdp, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </footer>

</body>
</html>
