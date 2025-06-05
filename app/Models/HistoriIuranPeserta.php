<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriIuranPeserta extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit karena tidak mengikuti konvensi plural Laravel
    protected $table = 'histori_iuran_peserta';

    // Primary key untuk tabel ini adalah 'id' dan auto-incrementing
    protected $primaryKey = 'id';
    public $incrementing = true; // id adalah auto-incrementing
    protected $keyType = 'int'; // id bertipe integer

    // Laravel secara otomatis mengelola created_at dan updated_at
    // Pastikan kolom ini ada di tabel histori_iuran_peserta
    public $timestamps = true;

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'nip',
        'tahun',
        'bulan',
        'phdp_bulan_ini',
        'ir_bulan_ini',
        'saldo_awal_peserta',
        'iuran_peserta',
        'hasil_pengembangan_peserta',
        'saldo_akhir_peserta',
        'saldo_awal_pemberi_kerja',
        'iuran_pemberi_kerja',
        'hasil_pengembangan_pemberi_kerja',
        'saldo_akhir_pemberi_kerja',
    ];

    /**
     * Definisi relasi dengan model Peserta.
     * HistoriIuranPeserta memiliki satu Peserta (melalui nip).
     */
    public function peserta()
    {
        // Sesuaikan 'nip' jika nama foreign key berbeda,
        // dan 'NIP' jika primary key di tabelpeserta adalah uppercase
        return $this->belongsTo(Peserta::class, 'nip', 'nip');
    }
}
