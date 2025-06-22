<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{

    protected $table = 'jabatans';
    protected $fillable = [
        'nama_jabatan',
        'tunjangan',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
