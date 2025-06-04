<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableKenaikan extends Model
{
    protected $table = 'tablekenaikan';
    public $timestamps = false;

    protected $fillable = ['jabatan', 'kenaikan']; 
}
