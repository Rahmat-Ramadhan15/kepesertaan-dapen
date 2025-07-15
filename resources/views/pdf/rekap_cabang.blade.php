<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Cabang</title>
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
        .text-center {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        @page {
            margin: 15mm;
            size: A4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN REKAP CABANG</h1>
        <p>Dapen Bank Sulselbar</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    @if($data->isEmpty())
        <p class="no-data">Tidak ada data cabang tersedia untuk ditampilkan.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cabang</th>
                    <th class="text-center">Jumlah Peserta</th>
                    <th class="text-end">Total PHDP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $row->nama_cabang }}</td>
                        <td class="text-center">{{ $row->total_peserta }}</td>
                        <td class="text-end">{{ number_format($row->total_phdp, 0, ',', '.') }}</td>
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
