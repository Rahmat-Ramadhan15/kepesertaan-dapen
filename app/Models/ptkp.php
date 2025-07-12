<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptkp extends Model
{
    protected $table = 'ptkp';
    protected $primaryKey = 'kode_ptkp';
    public $incrementing = false; 
    protected $keyType = 'string'; 


    protected $fillable = ['kode_ptkp', 'nilai_ptkp'];
}
