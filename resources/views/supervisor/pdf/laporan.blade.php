<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Iuran Pensiun</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 6px; text-align: center; }
        footer { text-align: center; margin-top: 40px; font-size: 11px; color: #555; }
    </style>
</head>
<body>

    <h2>Laporan Iuran Pensiun Bulan {{ $bulan }} Tahun {{ $tahun }}</h2>

    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>PhDP</th>
                <th>Iuran Peserta</th>
                <th>Hasil Pengembangan Peserta</th>
                <th>Saldo Akhir Peserta</th>
                <th>Iuran Pemberi Kerja</th>
                <th>Hasil Pengembangan Pemberi Kerja</th>
                <th>Saldo Akhir Pemberi Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->nip }}</td>
                <td>{{ number_format($row->phdp_bulan_ini, 2, ',', '.') }}</td>
                <td>{{ number_format($row->iuran_peserta, 2, ',', '.') }}</td>
                <td>{{ number_format($row->hasil_pengembangan_peserta, 2, ',', '.') }}</td>
                <td>{{ number_format($row->saldo_akhir_peserta, 2, ',', '.') }}</td>
                <td>{{ number_format($row->iuran_pemberi_kerja, 2, ',', '.') }}</td>
                <td>{{ number_format($row->hasil_pengembangan_pemberi_kerja, 2, ',', '.') }}</td>
                <td>{{ number_format($row->saldo_akhir_pemberi_kerja, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </footer>

</body>
</html>
