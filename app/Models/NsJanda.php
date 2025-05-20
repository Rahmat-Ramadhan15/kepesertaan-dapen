<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NsJanda extends Model
{    
    protected $table = 'ns_janda';
    protected $fillable = ['usia', 'nilai_sekarang','ns_anak'];
}