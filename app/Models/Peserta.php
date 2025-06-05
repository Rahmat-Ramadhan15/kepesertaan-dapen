<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Carbon\Carbon;

class Peserta extends Model
{
    use HasFactory,Auditable;

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
        'Updated_at',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tmk' => 'date',
        'tpst' => 'date',
        'phdp' => 'decimal:2',
        'akumulasi_ibhp' => 'decimal:2',
    ];

    public function keluargas()
    {
        return $this->hasMany(Keluarga::class, 'nip', 'nip');
    }

    public function keluarga()
    {
        return $this->hasMany(Keluarga::class, 'nip', 'nip');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'kode_cabang', 'kode_cabang');
    }

    public function getUmurAttribute()
    {
        // Pastikan tanggal_lahir bukan null
        if ($this->tanggal_lahir) {
            $age = Carbon::parse($this->tanggal_lahir)->diffInYears(now());

            // Bulatkan umur
            return round($age); // Menggunakan round() untuk membulatkan umur
        }

        // Jika tanggal_lahir null, bisa mengembalikan nilai default atau null
        return null;  // Atau bisa return 0 atau nilai lain sesuai kebutuhan
    }


    /**
     * Get masa kerja from join date
     */
    public function getMasaKerjaAttribute()
    {
        // Pastikan tmk valid
        if ($this->tmk) {
            // Hitung selisih tahun dan bulan
            $diff = now()->diff($this->tmk);

            // Jika ada sisa bulan, kita bulatkan ke atas menjadi 1 tahun
            $years = $diff->y;
            $months = $diff->m;

            // Jika ada lebih dari 0 bulan, kita tambahkan 1 tahun
            if ($months > 0 || $diff->d > 0) {
                $years++;
            }

            return $years;
        }

        return 0; // Jika tmk tidak ada, kembalikan 0
    }


    /**
     * Apply filters for printing report
     */
    public static function scopeApplyPrintFilter($query, $filters)
    {
        $query = self::with(['cabang', 'keluarga']);
        
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
