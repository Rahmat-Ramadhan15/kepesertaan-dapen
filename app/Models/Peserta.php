<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable; // Asumsi trait ini ada
use Carbon\Carbon;

class Peserta extends Model
{
    use HasFactory, Auditable; // Asumsi Auditable trait ada

    protected $table = 'tablepeserta';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'nama',
        'no_sk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'tmk',
        'mkmk',
        'tpst',
        'mkmp',
        'kode_peserta',
        'status_kawin',
        'kode_ptkp',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'kode_pos',
        'telpon',
        'pendidikan',
        'jurusan',
        'golongan',
        'kode_dir',
        'jabatan',
        'tahun_jabat',
        'phdp',
        'akumulasi_ibhp',
        'kode_cabang',
        'created_at',
        'updated_at', // <<< KOREKSI: UBAH DARI 'Updated_at' KE 'updated_at' (huruf kecil)
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tmk' => 'date',
        'tpst' => 'date',
        'phdp' => 'decimal:2',
        'akumulasi_ibhp' => 'decimal:2',
    ];

    // Relasi untuk keluarga (gunakan yang jamak untuk hasMany)
    public function keluargas()
    {
        return $this->hasMany(Keluarga::class, 'nip', 'nip');
    }

    // HAPUS FUNGSI public function keluarga() YANG DUPLIKAT INI

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'kode_cabang', 'kode_cabang');
    }

    public function getUmurAttribute()
    {
        if ($this->tanggal_lahir) {
            $age = Carbon::parse($this->tanggal_lahir)->diffInYears(now());
            return round($age);
        }
        return null;
    }

    public function getMasaKerjaAttribute()
    {
        if ($this->tmk) {
            $diff = now()->diff($this->tmk);
            $years = $diff->y;
            $months = $diff->m;
            if ($months > 0 || $diff->d > 0) {
                $years++;
            }
            return $years;
        }
        return 0;
    }

    public static function scopeApplyPrintFilter($query, $filters)
    {
        $query = self::with(['cabang', 'keluargas']); // Gunakan keluargas()

        // Filter by age range
        if (isset($filters['umur_min']) && isset($filters['umur_max'])) {
            $maxDate = now()->subYears($filters['umur_min'])->format('Y-m-d');
            $minDate = now()->subYears($filters['umur_max'])->format('Y-m-d');
            $query->whereBetween('tanggal_lahir', [$minDate, $maxDate]);
        }

        // Filter by branch
        if (!empty($filters['cabang'])) {
            $query->where('kode_cabang', $filters['cabang']);
        }

        // Filter by gender
        if (!empty($filters['jenis_kelamin'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }

        // Filter by marital status
        if (!empty($filters['status_pernikahan'])) {
            $query->where('status_pernikahan', $filters['status_pernikahan']);
        }

        // Filter by education
        if (!empty($filters['pendidikan'])) {
            $query->where('pendidikan', $filters['pendidikan']);
        }

        // Filter by PHDP range
        if (isset($filters['phdp_min']) && isset($filters['phdp_max'])) {
            $query->whereBetween('phdp', [$filters['phdp_min'], $filters['phdp_max']]);
        }

        // Filter by golongan
        if (!empty($filters['golongan'])) {
            $query->where('golongan', $filters['golongan']);
        }

        return $query;
    }
}