<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $filters;
    protected $jenisLaporan;

    public function __construct($filters = [], $jenisLaporan = 'umum')
    {
        $this->filters = $filters;
        $this->jenisLaporan = $jenisLaporan;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peserta::applyPrintFilter($this->filters)->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        switch ($this->jenisLaporan) {
            case 'detail':
                return [
                    'No',
                    'NIP',
                    'Nama',
                    'Tempat Lahir',
                    'Tanggal Lahir',
                    'Umur',
                    'Jenis Kelamin',
                    'Status Kawin',
                    'Alamat',
                    'Pendidikan',
                    'Golongan',
                    'Cabang',
                    'Tanggal Masuk',
                    'PHDP'
                ];
            case 'keluarga':
                return [
                    'No',
                    'NIP',
                    'Nama Peserta',
                    'Nama Keluarga',
                    'Hubungan',
                    'Jenis Kelamin',
                    'Tanggal Lahir',
                    'Umur'
                ];
            default: // umum
                return [
                    'No',
                    'NIP',
                    'Nama',
                    'Umur',
                    'Jenis Kelamin',
                    'Cabang',
                    'PHDP'
                ];
        }
    }

    /**
     * @param mixed $peserta
     * @return array
     */
    public function map($peserta): array
    {
        static $counter = 0;
        $counter++;

        switch ($this->jenisLaporan) {
            case 'detail':
                return [
                    $counter,
                    $peserta->nip,
                    $peserta->nama,
                    $peserta->tempat_lahir,
                    date('d-m-Y', strtotime($peserta->tanggal_lahir)),
                    $peserta->umur . ' th',
                    $peserta->jenis_kelamin,
                    $peserta->status_kawin,
                    $peserta->alamat,
                    $peserta->pendidikan,
                    $peserta->golongan,
                    $peserta->cabang->nama_cabang ?? '-',
                    date('d-m-Y', strtotime($peserta->tanggal_masuk)),
                    number_format($peserta->phdp, 0, ',', '.')
                ];
            case 'keluarga':
                // Untuk laporan keluarga, kita perlu menampilkan setiap anggota keluarga
                $rows = [];
                if ($peserta->keluarga && $peserta->keluarga->count() > 0) {
                    foreach ($peserta->keluarga as $keluarga) {
                        $rows[] = [
                            $counter,
                            $peserta->nip,
                            $peserta->nama,
                            $keluarga->nama,
                            $keluarga->hubungan,
                            $keluarga->jenis_kelamin,
                            date('d-m-Y', strtotime($keluarga->tanggal_lahir)),
                            $keluarga->umur . ' th'
                        ];
                        $counter++;
                    }
                } else {
                    $rows[] = [
                        $counter,
                        $peserta->nip,
                        $peserta->nama,
                        '-',
                        '-',
                        '-',
                        '-',
                        '-'
                    ];
                }
                return $rows;
            default: // umum
                return [
                    $counter,
                    $peserta->nip,
                    $peserta->nama,
                    $peserta->umur . ' th',
                    $peserta->jenis_kelamin,
                    $peserta->cabang->nama_cabang ?? '-',
                    number_format($peserta->phdp, 0, ',', '.')
                ];
        }
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        switch ($this->jenisLaporan) {
            case 'detail':
                return [
                    'A' => 5,   // No
                    'B' => 15,  // NIP
                    'C' => 25,  // Nama
                    'D' => 15,  // Tempat Lahir
                    'E' => 12,  // Tanggal Lahir
                    'F' => 8,   // Umur
                    'G' => 12,  // Jenis Kelamin
                    'H' => 12,  // Status Kawin
                    'I' => 30,  // Alamat
                    'J' => 12,  // Pendidikan
                    'K' => 10,  // Golongan
                    'L' => 15,  // Cabang
                    'M' => 12,  // Tanggal Masuk
                    'N' => 15,  // PHDP
                ];
            case 'keluarga':
                return [
                    'A' => 5,   // No
                    'B' => 15,  // NIP
                    'C' => 25,  // Nama Peserta
                    'D' => 25,  // Nama Keluarga
                    'E' => 12,  // Hubungan
                    'F' => 12,  // Jenis Kelamin
                    'G' => 12,  // Tanggal Lahir
                    'H' => 8,   // Umur
                ];
            default: // umum
                return [
                    'A' => 5,   // No
                    'B' => 15,  // NIP
                    'C' => 25,  // Nama
                    'D' => 8,   // Umur
                    'E' => 12,  // Jenis Kelamin
                    'F' => 15,  // Cabang
                    'G' => 15,  // PHDP
                ];
        }
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}