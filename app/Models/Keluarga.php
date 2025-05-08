<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

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
        return now()->diffInYears($this->tanggal_lahir);
    }
}
