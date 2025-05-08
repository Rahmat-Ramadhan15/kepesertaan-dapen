<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesertaExport implements FromCollection, WithHeadings
{
    protected $filters;

    // Konstruktor untuk menerima filter yang dikirimkan
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    // Mendapatkan data peserta berdasarkan filter yang diterima
    public function collection()
    {
        $query = Peserta::query();

        // Terapkan filter lainnya sesuai kebutuhan (jenis_kelamin, cabang, dll)

        return $query->get();
    }

    // Menentukan heading kolom untuk file Excel
    public function headings(): array
    {
        return [
            'ID', 
            'Nama', 
            'Jenis Laporan', 
            'Umur', 
            'Cabang', 
            'Jenis Kelamin',
            // Tambahkan kolom lainnya sesuai dengan data peserta
        ];
    }
}
