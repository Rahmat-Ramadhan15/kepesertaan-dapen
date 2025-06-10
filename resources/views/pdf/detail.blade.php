<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Peserta Dana Pensiun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 10px;
            line-height: 1.2;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h3 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
        }
        .header p {
            margin: 3px 0;
            font-size: 9px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 7px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
            padding: 3px;
            text-align: center;
            font-weight: bold;
            font-size: 7px;
        }
        td {
            padding: 2px;
            vertical-align: top;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .filter-info {
            margin-top: 10px;
            font-size: 7px;
            page-break-inside: avoid;
        }
        .filter-info h4 {
            margin: 0 0 5px 0;
            font-size: 8px;
        }
        .filter-info ul {
            margin: 0;
            padding-left: 10px;
        }
        .filter-info li {
            margin-bottom: 1px;
        }
        .total-info {
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN DETAIL PESERTA DANA PENSIUN</h3>
        <p>Per Tanggal: {{ $date ?? date('d F Y') }}</p>
    </div>

    <div class="total-info">
        Total Data: {{ $total ?? 0 }} peserta
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 8%;">NIP</th>
                <th style="width: 15%;">Nama</th>
                <th style="width: 8%;">Tempat Lahir</th>
                <th style="width: 8%;">Tgl Lahir</th>
                <th style="width: 5%;">Umur</th>
                <th style="width: 8%;">JK</th>
                <th style="width: 8%;">Status</th>
                <th style="width: 15%;">Alamat</th>
                <th style="width: 7%;">Pendidikan</th>
                <th style="width: 5%;">Gol</th>
                <th style="width: 10%;">PHDP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $key => $p)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $p->nip ?? '-' }}</td>
                <td>{{ $p->nama ?? '-' }}</td>
                <td>{{ $p->tempat_lahir ?? '-' }}</td>
                <td class="text-center">{{ $p->tanggal_lahir ? date('d-m-Y', strtotime($p->tanggal_lahir)) : '-' }}</td>
                <td class="text-center">{{ ($p->umur ?? 0) }}th</td>
                <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                <td>{{ $p->status_kawin ?? '-' }}</td>
                <td>{{ $p->alamat ?? '-' }}</td>
                <td>{{ $p->pendidikan ?? '-' }}</td>
                <td class="text-center">{{ $p->golongan ?? '-' }}</td>
                <td class="text-right">{{ number_format($p->phdp ?? 0, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="12" class="text-center">Tidak ada data yang sesuai dengan filter</td>
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