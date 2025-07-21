<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan NS Janda/Duda</title>
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
    <h1>LAPORAN NILAI SEKARANG - JANDA/DUDA</h1>
    <p>Dapen Bank Sulselbar</p>
    <p>Tanggal Cetak: {{ $date }}</p>

    @if($data->isEmpty())
        <p class="no-data">Tidak ada data NS janda/duda.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Usia</th>
                <th>Nilai Sekarang</th>
                <th>Ns Anak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $jd)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $jd->usia }}</td>
                    <td>{{ $jd->nilai_sekarang }}</td>
                    <td>{{ $jd->ns_anak }}</td>
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
