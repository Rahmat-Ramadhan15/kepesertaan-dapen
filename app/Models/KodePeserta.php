<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodePeserta extends Model
{
    protected $table = 'tablekodepst';
    protected $fillable = ['kode_peserta', 'ket_kd_pst'];
}
