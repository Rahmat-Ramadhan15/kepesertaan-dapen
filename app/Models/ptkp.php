<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptkp extends Model
{
    protected $table = 'ptkp';

    protected $fillable = ['kode_ptkp', 'nilai_ptkp'];
}
