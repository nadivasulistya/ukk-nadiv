<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusAlumni;

class StatusAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusAlumni = [
            ['status' => 'Bekerja'],
            ['status' => 'Kuliah'],
            ['status' => 'Wirausaha'],
            ['status' => 'Mencari Kerja'],
        ];

        foreach ($statusAlumni as $status) {
            StatusAlumni::create($status);
        }
    }
} 