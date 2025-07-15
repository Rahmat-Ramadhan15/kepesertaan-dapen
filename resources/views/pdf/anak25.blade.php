<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Anak Usia 22–25 Tahun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            margin: 15px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 3px 0 0 0;
            color: #666;
            font-size: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 6px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }
        @page {
            margin: 15mm;
            size: A4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DAFTAR ANAK YANG AKAN BERUSIA 25 TAHUN</h1>
        <p>Dapen Bank Sulselbar</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    @if($anak25->isEmpty())
        <p class="no-data">Tidak ada data anak dalam rentang usia 22–25 tahun.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>Nama Peserta</th>
                    <th>NIP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anak25 as $index => $anak)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anak->nama }}</td>
                        <td>{{ $anak->jenis_kelamin }}</td>
                        <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</td>
                        <td>{{ $anak->umur }} tahun</td>
                        <td>{{ $anak->peserta->nama ?? '-' }}</td>
                        <td>{{ $anak->peserta->nip ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>Dokumen ini dicetak otomatis pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>© 2025 Dapen Bank Sulselbar - Semua hak cipta dilindungi</p>
    </div>
</body>
</html>
