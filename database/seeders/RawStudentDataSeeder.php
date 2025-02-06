<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RawStudentData;

class RawStudentDataSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'name' => 'Ahmad Rizky',
                'nisn' => '0012345671',
                'nik' => '3273012345671234',
            ],
            [
                'name' => 'Budi Santoso',
                'nisn' => '0012345672',
                'nik' => '3273012345672234',
            ],
            [
                'name' => 'Citra Dewi',
                'nisn' => '0012345673',
                'nik' => '3273012345673234',
            ],
            [
                'name' => 'Dian Pratama',
                'nisn' => '0012345674',
                'nik' => '3273012345674234',
            ],
            [
                'name' => 'Eka Putri',
                'nisn' => '0012345675',
                'nik' => '3273012345675234',
            ],
        ];

        foreach ($students as $student) {
            RawStudentData::create($student);
        }
    }
} 