<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NsAnak extends Model
{    
    protected $table = 'ns_anak';
    protected $fillable = ['usia', 'nilai_sekarang'];
}