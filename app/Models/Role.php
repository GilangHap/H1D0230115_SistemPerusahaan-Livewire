<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
    ];

    public function jabatans()
    {
        return $this->hasMany(Jabatan::class);
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
