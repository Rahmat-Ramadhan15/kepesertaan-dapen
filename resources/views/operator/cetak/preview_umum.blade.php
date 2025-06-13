<div class="text-center mb-4">
    <h4>LAPORAN UMUM PESERTA DANA PENSIUN</h4>
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
    jenisLaporan.value = 'umum';
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

function exportExcel() {
    const filters = JSON.parse(document.getElementById('filter-data').textContent);
    
    // Create form untuk POST request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("export") }}';
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
    jenisLaporan.value = 'umum';
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