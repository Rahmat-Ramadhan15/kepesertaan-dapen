<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IuranParameter extends Model
{
    protected $table = 'iuran_parameters';

    protected $fillable = [
        'persentase_peserta',
        'persentase_pemberi_kerja',
    ];

    public $timestamps = true;
}
