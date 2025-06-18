<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Hasil Perhitungan Manfaat Pensiun</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>NIP</th>
                    <td>{{ $peserta->nip }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $peserta->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Pensiun</th>
                    <td class="text-capitalize">{{ str_replace('_', ' ', $jenis) }}</td>
                </tr>
                <tr>
                    <th>PhDP</th>
                    <td>Rp {{ number_format($peserta->phdp, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Masa Kerja</th>
                    <td>{{ $peserta->masa_kerja }} tahun</td>
                </tr>
                <tr>
                    <th>Manfaat Pensiun</th>
                    <td>
                        @if(is_numeric($mp))
                            <strong class="text-success">Rp {{ number_format($mp, 0, ',', '.') }}</strong>
                        @else
                            <strong class="text-warning">{{ $mp }}</strong>
                        @endif
                    </td>
                </tr>
            </table>

            <a href="{{ route('manfaat.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>