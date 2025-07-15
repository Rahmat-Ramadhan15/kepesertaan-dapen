<div class="text-center mb-4">
    <h4>LAPORAN REKAP CABANG</h4>
    <p>Per Tanggal: {{ date('d F Y') }}</p>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Total Cabang: {{ $data->count() }}</strong>
    </div>
    <div>
        <button type="button" class="btn btn-danger me-2" onclick="downloadPDFRekapCabang()">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Cabang</th>
                <th class="text-center">Jumlah Peserta</th>
                <th class="text-end">Total PHDP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $row->nama_cabang }}</td>
                    <td class="text-center">{{ $row->total_peserta }}</td>
                    <td class="text-end">{{ number_format($row->total_phdp, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function downloadPDFRekapCabang() {
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
    jenis.value = 'rekap_cabang';
    form.appendChild(jenis);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
</script>
