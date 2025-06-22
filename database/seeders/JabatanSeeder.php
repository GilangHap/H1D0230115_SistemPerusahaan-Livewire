<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;
use App\Models\Role;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get role IDs
        $adminRole = Role::where('name', 'admin')->first();
        $atasanRole = Role::where('name', 'atasan')->first();
        $staffRole = Role::where('name', 'staff')->first();

        // Create jabatan for admin
        Jabatan::create([
            'nama_jabatan' => 'IT Manager',
            'tunjangan' => 5000000,
            'role_id' => $adminRole->id,
        ]);

        // Create jabatan for atasan
        Jabatan::create([
            'nama_jabatan' => 'Supervisor Keuangan',
            'tunjangan' => 3000000,
            'role_id' => $atasanRole->id,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Supervisor Pemasaran',
            'tunjangan' => 3000000,
            'role_id' => $atasanRole->id,
        ]);

        // Create jabatan for staff
        Jabatan::create([
            'nama_jabatan' => 'Staff Administrasi',
            'tunjangan' => 1000000,
            'role_id' => $staffRole->id,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff Keuangan',
            'tunjangan' => 1000000,
            'role_id' => $staffRole->id,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff Pemasaran',
            'tunjangan' => 1000000,
            'role_id' => $staffRole->id,
        ]);
    }
}
