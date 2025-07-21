<div class="text-center mb-4">
    <h4>LAPORAN DAFTAR ANAK YANG AKAN BERUSIA 25 TAHUN</h4>
    <p>Per Tanggal: {{ date('d F Y') }}</p>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Total Data: {{ $anak25->count() }} anak</strong>
    </div>
    <div>
        <button type="button" class="btn btn-danger me-2" onclick="downloadPDFAnak()">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Anak</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
                <th>Nama Peserta</th>
                <th>NIP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anak25 as $index => $anak)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $anak->nama }}</td>
                    <td>{{ $anak->jenis_kelamin }}</td>
                    <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}</td>
                    <td class="text-center">{{ $anak->usia }} th</td>
                    <td>{{ $anak->peserta->nama ?? '-' }}</td>
                    <td>{{ $anak->peserta->nip ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data anak dalam rentang usia 22–25 tahun.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Hidden filters (if any) -->
<div id="filter-anak" style="display: none;">
    {{ json_encode($filters) }}
</div>

<script>
function downloadPDFAnak() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("generate-pdf") }}';
    form.style.display = 'none';

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    const jenis = document.createElement('input');
    jenis.type = 'hidden';
    jenis.name = 'jenis_laporan';
    jenis.value = 'anak_25'; // ✅ sesuaikan dengan controller
    form.appendChild(jenis);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

</script>
