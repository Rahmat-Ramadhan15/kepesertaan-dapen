<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peserta::select('nip', 'nama', 'jenis_kelamin', 'jabatan', 'phdp')->get();
        
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Jenis Kelamin',
            'Jabatan',
            'PHDP',
        ];
    }

}
