<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitKerja::create([
            'nama_unit' => 'Divisi IT',
            'lokasi' => 'Jl. IT No. 1, Jakarta',
        ]);

        UnitKerja::create([
            'nama_unit' => 'Divisi Keuangan',
            'lokasi' => 'Jl. Keuangan No. 2, Jakarta',
        ]);

        UnitKerja::create([
            'nama_unit' => 'Divisi Pemasaran',
            'lokasi' => 'Jl. Pemasaran No. 3, Jakarta',
        ]);

        UnitKerja::create([
            'nama_unit' => 'Divisi SDM',
            'lokasi' => 'Jl. SDM No. 4, Jakarta',
        ]);

        UnitKerja::create([
            'nama_unit' => 'Divisi Operasional',
            'lokasi' => 'Jl. Operasional No. 5, Jakarta',
        ]);
    }
}
