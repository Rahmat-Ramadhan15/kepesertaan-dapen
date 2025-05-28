<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model // <<< Ubah nama kelas
{
    use HasFactory;

    protected $table = 'tablecabang'; // Nama tabel di database
    protected $primaryKey = 'kode_cabang'; // Tentukan primary key (lowercase)
    public $incrementing = false; // Primary key bukan auto-incrementing integer
    protected $keyType = 'string'; // Primary key bertipe string
    public $timestamps = false; // Nonaktifkan timestamps karena tabel tidak ada created_at/updated_at

    protected $fillable = [
        'kode_cabang',
        'nama_cabang',
        'kode_alias',
        'alamat',
        'kota',
        'kode_pos',
        'telepon',
        'fax',
        'email',
    ];

    public function getRouteKeyName()
    {
        return 'kode_cabang';
    }
}