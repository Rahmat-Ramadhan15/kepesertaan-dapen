<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBank extends Model
{
    use HasFactory;

    protected $table = 'tablebank';
    protected $primaryKey = 'kode_cabang'; // <<< Set kode_cabang sebagai Primary Key
    public $incrementing = false; // <<< Penting: set false karena bukan auto-incrementing integer
    protected $keyType = 'string'; // <<< Penting: set string karena kode_cabang seringkali berupa string atau diperlakukan sebagai string

    protected $fillable = [
        'kode_bank',
        'nama_bank',
        'kode_cabang',
        'nama_cabang',
        'kode_full',
        'alamat',
        'kota',
        'kode_pos',
        'telepon',
        'fax',
        'email',
    ];

    /**
     * Get the route key for the model.
     * Sudah benar menggunakan 'kode_cabang' karena ini juga yang akan digunakan di URL.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'kode_cabang';
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'kode_cabang', 'kode_cabang');
    }

}