<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $fillable = ['nama_cabang', 'alamat'];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'cabang_id');
    }

}
