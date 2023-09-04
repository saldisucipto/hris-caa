<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_cuti = [
            [
                'jenis_cuti' => 'CUTI BERSAMA'
            ],
            [
                'jenis_cuti' => 'CUTI TAHUNAN'
            ],
            [
                'jenis_cuti' => 'IZIN PRIBADI'
            ],
            [
                'jenis_cuti' => 'CUTI SAKIT / IZIN TANPA SURAT DOKTER'
            ],
            [
                'jenis_cuti' => 'CUTI HAMIL'
            ],
        ];

        JenisCuti::insert($jenis_cuti);
    }
}
