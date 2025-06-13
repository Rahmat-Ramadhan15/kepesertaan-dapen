<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Umum Peserta Dana Pensiun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 20px;
            line-height: 1.4;
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #007bff;
        }
        
        .header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            text-transform: uppercase;
        }
        
        .header p {
            margin: 8px 0 0 0;
            font-size: 12px;
            color: #666;
        }
        
        .info-section {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            margin: 15px 0 5px 0;
            font-weight: bold;
            font-size: 12px;
            border-radius: 3px;
        }
        
        .total-info {
            background-color: #e9ecef;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 11px;
            border-left: 4px solid #007bff;
            color: #495057;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
            background-color: white;
        }
        
        table, th, td {
            border: 1px solid #dee2e6;
        }
        
        th {
            background-color: #f8f9fa;
            padding: 8px 6px;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
            color: #495057;
            border-bottom: 2px solid #007bff;
        }
        
        td {
            padding: 6px 8px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e3f2fd;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        
        .filter-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .filter-section h4 {
            margin: 0 0 10px 0;
            font-size: 12px;
            color: #495057;
            font-weight: bold;
        }
        
        .filter-section ul {
            margin: 0;
            padding-left: 20px;
            list-style-type: disc;
        }
        
        .filter-section li {
            margin-bottom: 4px;
            color: #6c757d;
            font-size: 10px;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-style: italic;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        /* Print styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
                padding: 10px;
            }
            tr:hover {
                background-color: transparent !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>Laporan Umum Peserta Dana Pensiun</h3>
            <p>Tanggal: {{ date('d M Y') }}</p>
        </div>

        <div class="info-section">
            Data Peserta
        </div>

        <div class="total-info">
            Total Data: {{ $total ?? 0 }} peserta
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">NIP</th>
                    <th style="width: 25%;">Nama</th>
                    <th style="width: 8%;">Umur</th>
                    <th style="width: 12%;">Jenis Kelamin</th>
                    <th style="width: 20%;">Cabang</th>
                    <th style="width: 18%;">PHDP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peserta as $key => $p)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-left">{{ $p->nip ?? '-' }}</td>
                    <td class="text-left">{{ $p->nama ?? '-' }}</td>
                    <td class="text-center">{{ ($p->umur ?? 0) }} th</td>
                    <td class="text-center">{{ $p->jenis_kelamin ?? '-' }}</td>
                    <td class="text-left">{{ $p->cabang->nama_cabang ?? '-' }}</td>
                    <td class="text-right">{{ number_format($p->phdp ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="no-data">Tidak ada data yang sesuai dengan filter</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="filter-section">
            <h4>Filter yang diterapkan:</h4>
            <ul>
                <li>Umur: {{ $filters['umur_min'] ?? '18' }} - {{ $filters['umur_max'] ?? '100' }} tahun</li>
                @if(!empty($filters['jenis_kelamin']))
                    <li>Jenis Kelamin: {{ $filters['jenis_kelamin'] }}</li>
                @endif
                @if(!empty($filters['cabang']))
                    @php
                        $cabangName = 'Semua Cabang';
                        if(class_exists('App\Models\Cabang')) {
                            $cabang = App\Models\Cabang::find($filters['cabang']);
                            $cabangName = $cabang ? $cabang->nama_cabang : 'Semua Cabang';
                        }
                    @endphp
                    <li>Cabang: {{ $cabangName }}</li>
                @endif
                @if(!empty($filters['status_kawin']))
                    <li>Status Pernikahan: {{ $filters['status_kawin'] }}</li>
                @endif
                @if(!empty($filters['pendidikan']))
                    <li>Pendidikan: {{ $filters['pendidikan'] }}</li>
                @endif
                @if(!empty($filters['golongan']))
                    <li>Golongan: {{ $filters['golongan'] }}</li>
                @endif
            </ul>
        </div>

        <div class="footer">
            © {{ date('Y') }} Sistem Dana Pensiun - Laporan dicetak secara otomatis pada {{ date('d-m-Y H:i:s') }}
        </div>
    </div>
</body>
</html>