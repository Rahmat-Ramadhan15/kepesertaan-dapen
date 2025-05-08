<div class="text-center mb-4">
    <h4>LAPORAN UMUM PESERTA DANA PENSIUN</h4>
    <p>Per Tanggal: {{ date('d F Y') }}</p>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIP</th>
                <th width="25%">Nama</th>
                <th width="10%">Umur</th>
                <th width="15%">Jenis Kelamin</th>
                <th width="15%">Cabang</th>
                <th width="15%">PHDP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $key => $p)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->nama }}</td>
                <td class="text-center">{{ $p->umur }} th</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>{{ $p->cabang->nama_cabang ?? '-' }}</td>
                <td class="text-end">{{ number_format($p->phdp, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data yang sesuai dengan filter</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    <p><strong>Filter yang diterapkan:</strong></p>
    <ul>
        <li>Umur: {{ $filters['umur_min'] ?? '18' }} - {{ $filters['umur_max'] ?? '65' }} tahun</li>
        @if(!empty($filters['jenis_kelamin']))
            <li>Jenis Kelamin: {{ $filters['jenis_kelamin'] }}</li>
        @endif
        @if(!empty($filters['cabang']))
            <li>Cabang: {{ App\Models\Cabang::find($filters['cabang'])->nama_cabang ?? 'Semua Cabang' }}</li>
        @endif
        @if(!empty($filters['status_pernikahan']))
            <li>Status Pernikahan: {{ $filters['status_pernikahan'] }}</li>
        @endif
        @if(!empty($filters['pendidikan']))
            <li>Pendidikan: {{ $filters['pendidikan'] }}</li>
        @endif
        @if(!empty($filters['golongan']))
            <li>Golongan: {{ $filters['golongan'] }}</li>
        @endif
    </ul>
</div>

<!-- Hidden span for JavaScript to get count -->
<span class="d-none peserta-count" data-count="{{ $peserta->count() }}"></span>