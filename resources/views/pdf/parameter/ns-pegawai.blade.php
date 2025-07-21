<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan NS Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, p { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        .no-data { text-align: center; margin-top: 20px; }
        footer { text-align: center; margin-top: 40px; font-size: 11px; color: #555; }
    </style>
</head>
<body>
    <h1>LAPORAN NILAI SEKARANG - PEGAWAI</h1>
    <p>Dapen Bank Sulselbar</p>
    <p>Tanggal Cetak: {{ $date }}</p>

    @if($data->isEmpty())
        <p class="no-data">Tidak ada data NS pegawai.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Usia</th>
                <th>Nilai Sekarang</th>
                <th>Ns Janda</th>
                <th>Ns Anak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $pegawai)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $pegawai->usia }}</td>
                    <td>{{ $pegawai->nilai_sekarang }}</td>
                    <td>{{ $pegawai->ns_janda }}</td>
                    <td>{{ $pegawai->ns_anak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <footer>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </footer>
</body>
</html>
