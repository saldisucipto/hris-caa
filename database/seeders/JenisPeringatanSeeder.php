<?php

namespace Database\Seeders;

use App\Models\JenisPeringatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPeringatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_peringatan = [
            [
                'jenis_peringatan' => 'Surat Peringatan 1',
                'lama_peringatan' => 3,
            ],
            [
                'jenis_peringatan' => 'Surat Peringatan 2',
                'lama_peringatan' => 6,
            ],  [
                'jenis_peringatan' => 'Surat Peringatan 3',
                'lama_peringatan' => 1,
            ],

        ];

        JenisPeringatan::insert($jenis_peringatan);
    }
}
