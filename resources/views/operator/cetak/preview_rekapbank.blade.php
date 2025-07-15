<div class="text-center mb-4">
    <h4>LAPORAN REKAP BANK SULSELBAR</h4>
    <p>Per Tanggal: {{ $date }}</p>
</div>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Total Peserta: {{ $totalPeserta }} orang</strong> |
        <strong>Jumlah Cabang: {{ $jumlahCabang }}</strong> |
        <strong>Total PHDP: Rp {{ number_format($totalPhdp, 0, ',', '.') }}</strong> |
        <strong>Rata-rata PHDP: Rp {{ number_format($rataPhdp, 0, ',', '.') }}</strong>
    </div>
    <div>
        <button type="button" class="btn btn-danger me-2" onclick="downloadPDFBank()">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th>Kode Cabang</th>
                <th>Nama Cabang</th>
                <th>Kode Full</th>
                <th>Jumlah Peserta</th>
                <th>Rata-rata PHDP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $item['kode_bank'] }}</td>
                    <td>{{ $item['nama_bank'] }}</td>
                    <td>{{ $item['kode_cabang'] }}</td>
                    <td>{{ $item['nama_cabang'] }}</td>
                    <td>{{ $item['kode_full'] }}</td>
                    <td class="text-center">{{ $item['jumlah_peserta'] }}</td>
                    <td class="text-end">Rp {{ number_format($item['rata_phdp'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function downloadPDFBank() {
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
    jenis.value = 'rekap_bank';
    form.appendChild(jenis);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
</script>
