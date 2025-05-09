<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Cabang extends Model
{
    use Auditable;
    public $timestamps = false;
    protected $fillable = ['nama_cabang', 'alamat'];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'cabang_id');
    }

}
