<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get jabatan
        $itManager = Jabatan::where('nama_jabatan', 'IT Manager')->first();
        $supKeuangan = Jabatan::where('nama_jabatan', 'Supervisor Keuangan')->first();
        $supPemasaran = Jabatan::where('nama_jabatan', 'Supervisor Pemasaran')->first();
        $staffAdmin = Jabatan::where('nama_jabatan', 'Staff Administrasi')->first();
        $staffKeuangan = Jabatan::where('nama_jabatan', 'Staff Keuangan')->first();
        $staffPemasaran = Jabatan::where('nama_jabatan', 'Staff Pemasaran')->first();

        // Get unit kerja
        $divisiIT = UnitKerja::where('nama_unit', 'Divisi IT')->first();
        $divisiKeuangan = UnitKerja::where('nama_unit', 'Divisi Keuangan')->first();
        $divisiPemasaran = UnitKerja::where('nama_unit', 'Divisi Pemasaran')->first();
        $divisiSDM = UnitKerja::where('nama_unit', 'Divisi SDM')->first();

        // Create admin user
        Pegawai::create([
            'nip' => 'A001',
            'nama' => 'Admin Sistem',
            'jabatan_id' => $itManager->id,
            'unit_kerja_id' => $divisiIT->id,
            'gaji_pokok' => 10000000,
            'email' => 'admin@example.com',
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Admin No. 1, Jakarta',
            'password' => Hash::make('admin123'),
        ]);

        // Create atasan users
        Pegawai::create([
            'nip' => 'B001',
            'nama' => 'Supervisor Keuangan',
            'jabatan_id' => $supKeuangan->id,
            'unit_kerja_id' => $divisiKeuangan->id,
            'gaji_pokok' => 8000000,
            'email' => 'atasan.keuangan@example.com',
            'no_telp' => '081234567891',
            'alamat' => 'Jl. Keuangan No. 2, Jakarta',
            'password' => Hash::make('atasan123'),
        ]);

        Pegawai::create([
            'nip' => 'B002',
            'nama' => 'Supervisor Pemasaran',
            'jabatan_id' => $supPemasaran->id,
            'unit_kerja_id' => $divisiPemasaran->id,
            'gaji_pokok' => 7500000,
            'email' => 'atasan.pemasaran@example.com',
            'no_telp' => '081234567892',
            'alamat' => 'Jl. Pemasaran No. 3, Jakarta',
            'password' => Hash::make('atasan123'),
        ]);

        // Create staff users
        Pegawai::create([
            'nip' => 'C001',
            'nama' => 'Staff Administrasi',
            'jabatan_id' => $staffAdmin->id,
            'unit_kerja_id' => $divisiSDM->id,
            'gaji_pokok' => 5000000,
            'email' => 'staff.admin@example.com',
            'no_telp' => '081234567893',
            'alamat' => 'Jl. Administrasi No. 4, Jakarta',
            'password' => Hash::make('staff123'),
        ]);

        Pegawai::create([
            'nip' => 'C002',
            'nama' => 'Staff Keuangan 1',
            'jabatan_id' => $staffKeuangan->id,
            'unit_kerja_id' => $divisiKeuangan->id,
            'gaji_pokok' => 4500000,
            'email' => 'staff.keuangan1@example.com',
            'no_telp' => '081234567894',
            'alamat' => 'Jl. Keuangan No. 5, Jakarta',
            'password' => Hash::make('staff123'),
        ]);

        Pegawai::create([
            'nip' => 'C003',
            'nama' => 'Staff Pemasaran 1',
            'jabatan_id' => $staffPemasaran->id,
            'unit_kerja_id' => $divisiPemasaran->id,
            'gaji_pokok' => 4500000,
            'email' => 'staff.pemasaran1@example.com',
            'no_telp' => '081234567895',
            'alamat' => 'Jl. Pemasaran No. 6, Jakarta',
            'password' => Hash::make('staff123'),
        ]);
    }
}
