<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Carbon\Carbon;

class Keluarga extends Model
{
    use HasFactory,Auditable;

    protected $table = 'keluargas';

    protected $fillable = [
        'nip',
        'nama',
        'hubungan',
        'jenis_kelamin',
        'tanggal_lahir',
        'status_hidup',
        'pekerjaan',
    ];

    protected $dates = ['tanggal_lahir'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nip', 'nip');
    }

    public function getUmurAttribute()
    {
        if ($this->tanggal_lahir) {
            $age = Carbon::parse($this->tanggal_lahir)->diffInYears(now());
    
            // Bulatkan umur ke atas
            return ceil($age); // Menggunakan ceil() untuk membulatkan ke atas
        }
    
        return null; 
    }
}
