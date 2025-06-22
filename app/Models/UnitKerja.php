<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unit_kerjas';

    protected $fillable = [
        'nama_unit',
        'lokasi',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
