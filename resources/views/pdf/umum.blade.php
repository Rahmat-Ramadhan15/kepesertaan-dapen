<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Umum Peserta Dana Pensiun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 15px;
            line-height: 1.3;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
        }
        td {
            padding: 4px;
            vertical-align: top;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .filter-info {
            margin-top: 15px;
            font-size: 9px;
            page-break-inside: avoid;
        }
        .filter-info h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
        }
        .filter-info ul {
            margin: 0;
            padding-left: 15px;
        }
        .filter-info li {
            margin-bottom: 2px;
        }
        .total-info {
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN UMUM PESERTA DANA PENSIUN</h3>
        <p>Per Tanggal: {{ $date ?? date('d F Y') }}</p>
    </div>

    <div class="total-info">
        Total Data: {{ $total ?? 0 }} peserta
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">NIP</th>
                <th style="width: 25%;">Nama</th>
                <th style="width: 10%;">Umur</th>
                <th style="width: 15%;">Jenis Kelamin</th>
                <th style="width: 15%;">Cabang</th>
                <th style="width: 15%;">PHDP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $key => $p)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $p->nip ?? '-' }}</td>
                <td>{{ $p->nama ?? '-' }}</td>
                <td class="text-center">{{ ($p->umur ?? 0) }} th</td>
                <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                <td>{{ $p->cabang->nama_cabang ?? '-' }}</td>
                <td class="text-right">{{ number_format($p->phdp ?? 0, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data yang sesuai dengan filter</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="filter-info">
        <h4>Filter yang diterapkan:</h4>
        <ul>
            <li>Umur: {{ $filters['umur_min'] ?? '18' }} - {{ $filters['umur_max'] ?? '65' }} tahun</li>
            @if(!empty($filters['jenis_kelamin']))
                <li>Jenis Kelamin: {{ $filters['jenis_kelamin'] }}</li>
            @endif
            @if(!empty($filters['cabang']))
                @php
                    $cabangName = '';
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
</body>
</html>