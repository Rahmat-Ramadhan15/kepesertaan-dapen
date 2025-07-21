<div class="text-center mb-4">
    <h4>LAPORAN DETAIL PESERTA DANA PENSIUN</h4>
    <p>Per Tanggal: {{ date('d F Y') }}</p>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Total Data: {{ $peserta->count() }} peserta</strong>
    </div>
    <div>
        <button type="button" class="btn btn-danger me-2" onclick="downloadPDF()">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
        
    </div>
</div>

@forelse($peserta as $key => $p)
<div class="card mb-3">
    <div class="card-header bg-light">
        <strong>{{ $key + 1 }}. {{ $p->nama }}</strong> ({{ $p->nip }})
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="40%">Jenis Kelamin</td>
                        <td>: {{ $p->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tgl Lahir</td>
                        <td>: {{ $p->tempat_lahir }}, {{ $p->tanggal_lahir->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>: {{ $p->umur }} tahun</td>
                    </tr>
                    <tr>
                        <td>Status Pernikahan</td>
                        <td>: {{ $p->status_kawin }}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>: {{ $p->pendidikan }} {{ $p->jurusan ? '- '.$p->jurusan : '' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $p->alamat }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="40%">Cabang</td>
                        <td>: {{ $p->cabang->nama_cabang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Golongan</td>
                        <td>: {{ $p->golongan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>: {{ $p->tmk ? $p->tmk->format('d-m-Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Masa Kerja</td>
                        <td>: {{ $p->masa_kerja ?? '-' }} tahun</td>
                    </tr>
                    <tr>
                        <td>PHDP</td>
                        <td>: Rp {{ number_format($p->phdp, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>: <span class="badge bg-success">{{ $p->kodePeserta->ket_kd_pst ?? '-' }}</span></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
@empty
<div class="alert alert-info">
    <i class="fas fa-info-circle me-2"></i> Tidak ada data yang sesuai dengan filter
</div>
@endforelse

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

<!-- Hidden data for JavaScript -->
<div id="filter-data" style="display: none;">
    {{ json_encode($filters) }}
</div>

<script>
function downloadPDF() {
    const filters = JSON.parse(document.getElementById('filter-data').textContent);
    
    // Create form untuk POST request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("generate-pdf") }}';
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    // Add jenis_laporan
    const jenisLaporan = document.createElement('input');
    jenisLaporan.type = 'hidden';
    jenisLaporan.name = 'jenis_laporan';
    jenisLaporan.value = 'detail';
    form.appendChild(jenisLaporan);
    
    // Add filters
    Object.keys(filters).forEach(key => {
        if (filters[key] !== null && filters[key] !== '') {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = filters[key];
            form.appendChild(input);
        }
    });
    
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}


</script>