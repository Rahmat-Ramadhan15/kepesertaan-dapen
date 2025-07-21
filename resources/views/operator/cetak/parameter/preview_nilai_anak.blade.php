<div class="text-center mb-4">
    <h4>LAPORAN NILAI SEKARANG ANAK</h4>
    <p>Per Tanggal: {{ date('d F Y') }}</p>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Total Data: {{ $data->count() }} Nilai</strong>
    </div>
    <div>
        <button type="button" class="btn btn-danger me-2" onclick="downloadPDF('nilai_anak')">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Usia</th>
                <th>Nilai Sekarang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
            <tr>
                <td class="text-start">{{ $index + 1 }}</td>
                <td>{{ $item->usia }}</td>
                <td>{{ $item->nilai_sekarang }}</td>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function downloadPDF(jenis) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("generate-pdf") }}';
    form.style.display = 'none';

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    const jenisInput = document.createElement('input');
    jenisInput.type = 'hidden';
    jenisInput.name = 'jenis_laporan';
    jenisInput.value = jenis;
    form.appendChild(jenisInput);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
</script>
