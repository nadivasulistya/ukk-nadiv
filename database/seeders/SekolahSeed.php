<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sekolah::create([
            'nama_sekolah' => 'SMK Antartika 1 Sidoarjo',
            'npsn' => '20200001',
            'alamat' => 'Jl. Raya Sidoarjo - Gresik',
            'no_telp' => '08123456789',
            'email' => 'info@antartika1.sidoarjo.id',
            'website' => 'https://antartika1.sidoarjo.id',
       
            'nss' => '2432423',
        ]);
    }
}
