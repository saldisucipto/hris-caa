<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradeEmployee;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $grade = [
            [
                'grade' => '1A'
            ],
            [
                'grade' => '2A'
            ],
            [
                'grade' => '2B'
            ],
            [
                'grade' => '3A'
            ],
            [
                'grade' => '3B'
            ],
            [
                'grade' => '4A'
            ],
            [
                'grade' => '4B'
            ],
        ];

        GradeEmployee::insert($grade);
    }
}
