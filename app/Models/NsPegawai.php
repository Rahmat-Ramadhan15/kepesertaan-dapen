<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NsPegawai extends Model
{    
    protected $table = 'ns_pegawai';
    protected $fillable = ['usia', 'nilai_sekarang','ns_janda','ns_anak'];
}