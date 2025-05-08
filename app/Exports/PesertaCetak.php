<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaCetak implements FromQuery, WithHeadings, WithMapping, WithTitle, WithStyles
{
    protected $filters;
    protected $type;

    public function __construct($filters, $type = 'umum')
    {
        $this->filters = $filters;
        $this->type = $type;
    }

    public function collection()
    {
        return Peserta::applyPrintFilter($this->filters)->get();
    }

    public function headings(): array
    {
        switch ($this->type) {
            case 'detail':
                return [
                    'NIP',
                    'Nama',
                    'Jenis Kelamin',
                    'Tempat Lahir',
                    'Tanggal Lahir',
                    'Umur',
                    'Status Pernikahan',
                    'Pendidikan',
                    'Jurusan',
                    'Alamat',
                    'Cabang',
                    'Golongan',
                    'Tanggal Masuk',
                    'Masa Kerja',
                    'PHDP'
                ];
            case 'keluarga':
                return [
                    'NIP',
                    'Nama Peserta',
                    'Jenis Kelamin',
                    'Umur',
                    'Status Pernikahan',
                    'Cabang',
                    'Golongan',
                    'PHDP',
                    'Nama Anggota Keluarga',
                    'Hubungan',
                    'Tanggal Lahir',
                    'Umur Anggota',
                    'Pekerjaan'
                ];
            default: // umum
                return [
                    'NIP',
                    'Nama',
                    'Umur',
                    'Jenis Kelamin',
                    'Cabang',
                    'PHDP'
                ];
        }
    }

    public function map($peserta): array
    {
        switch ($this->type) {
            case 'detail':
                return [
                    $peserta->nip,
                    $peserta->nama,
                    $peserta->jenis_kelamin,
                    $peserta->tempat_lahir,
                    $peserta->tanggal_lahir->format('d-m-Y'),
                    $peserta->umur,
                    $peserta->status_pernikahan,
                    $peserta->pendidikan,
                    $peserta->jurusan,
                    $peserta->alamat,
                    $peserta->cabang->nama_cabang ?? '-',
                    $peserta->golongan,
                    $peserta->tmk ? $peserta->tmk->format('d-m-Y') : '-',
                    $peserta->masa_kerja ?? '-',
                    $peserta->phdp
                ];
            case 'keluarga':
                // For keluarga, we need to handle multiple rows per peserta
                $data = [];
                if ($peserta->keluargas->isEmpty()) {
                    $data[] = [
                        $peserta->nip,
                        $peserta->nama,
                        $peserta->jenis_kelamin,
                        $peserta->umur,
                        $peserta->status_pernikahan,
                        $peserta->cabang->nama_cabang ?? '-',
                        $peserta->golongan,
                        $peserta->phdp,
                        'Tidak ada data keluarga',
                        '-',
                        '-',
                        '-',
                        '-'
                    ];
                } else {
                    foreach ($peserta->keluargas as $k => $keluarga) {
                        $data[] = [
                            $peserta->nip,
                            $peserta->nama,
                            $peserta->jenis_kelamin,
                            $peserta->umur,
                            $peserta->status_pernikahan,
                            $peserta->cabang->nama_cabang ?? '-',
                            $peserta->golongan,
                            $peserta->phdp,
                            $keluarga->nama,
                            $keluarga->hubungan,
                            $keluarga->tanggal_lahir->format('d-m-Y'),
                            $keluarga->umur,
                            $keluarga->pekerjaan
                        ];
                    }
                }
                return $data;
            default: // umum
                return [
                    $peserta->nip,
                    $peserta->nama,
                    $peserta->umur,
                    $peserta->jenis_kelamin,
                    $peserta->cabang->nama_cabang ?? '-',
                    $peserta->phdp
                ];
        }
    }

    public function title(): string
    {
        switch ($this->type) {
            case 'detail':
                return 'Laporan Detail Peserta';
            case 'keluarga':
                return 'Laporan Keluarga Peserta';
            default:
                return 'Laporan Umum Peserta';
        }
    }
}