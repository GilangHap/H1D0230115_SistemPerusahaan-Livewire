<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    
    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status', // hadir, terlambat, cuti, alpa
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        // Tidak perlu cast ke datetime karena column adalah TIME, bukan DATETIME
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
