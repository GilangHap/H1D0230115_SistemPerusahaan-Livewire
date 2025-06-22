<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawais';

    protected $fillable = [
        'nip',
        'nama',
        'password',
        'jabatan_id',
        'unit_kerja_id',
        'gaji_pokok',
        'email',
        'no_telp',
        'alamat',
        'foto_profil',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the jabatan associated with the pegawai
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
    
    /**
     * Get the role through jabatan relationship
     */
    public function role(): HasOneThrough
    {
        return $this->hasOneThrough(
            Role::class,
            Jabatan::class,
            'id', // Foreign key on the jabatan table
            'id', // Foreign key on the roles table
            'jabatan_id', // Local key on the pegawai table
            'role_id' // Local key on the jabatan table
        );
    }
    
    /**
     * Get role attribute as a helper
     */
    public function getRoleAttribute()
    {
        return $this->jabatan ? $this->jabatan->role : null;
    }
    
    /**
     * Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        // Eager load jabatan dan role jika belum di-load
        if (!$this->relationLoaded('jabatan')) {
            $this->load('jabatan.role');
        }
        
        if (!$this->jabatan || !$this->jabatan->role) {
            return false;
        }
        
        return $this->jabatan->role->name === $roleName;
    }

    public function pegawaicount()
    {
        return $this->hasMany(Pegawai::class, 'unit_kerja_id', 'id')->count();
    }
}
