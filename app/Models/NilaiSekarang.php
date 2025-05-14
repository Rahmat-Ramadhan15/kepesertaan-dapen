<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSekarang extends Model
{    
    protected $table = 'nilai_sekarang';
    protected $fillable = ['usia', 'nilai_sekarang'];
}
