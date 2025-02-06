<?php
// File: app/Models/Identitas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Identitas extends Model
{
    use HasFactory;

    protected $table = 'tbl_identitas';
    protected $primaryKey = 'id_identitas';
    
    protected $fillable = [
        'id_alumni',
        'nisn',
        'nik'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni', 'id_alumni');
    }

    public static function generateNISN($tglLahir, $namaDepan)
    {
        $tahun = date('y', strtotime($tglLahir));
        $bulan = date('m', strtotime($tglLahir));
        $random = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $nisn = $tahun . $bulan . $random;
        
        while (self::where('nisn', $nisn)->exists()) {
            $random = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $nisn = $tahun . $bulan . $random;
        }
        
        return $nisn;
    }

    public static function generateNIK($tglLahir, $jenisKelamin)
    {
        $kodeWilayah = "327305";
        $tanggal = date('d', strtotime($tglLahir));
        $bulan = date('m', strtotime($tglLahir));
        $tahun = date('y', strtotime($tglLahir));
        
        if ($jenisKelamin === 'Perempuan') {
            $tanggal = intval($tanggal) + 40;
        }
        
        $random = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        $nik = $kodeWilayah . 
               str_pad($tanggal, 2, '0', STR_PAD_LEFT) . 
               $bulan . 
               $tahun . 
               $random;
        
        while (self::where('nik', $nik)->exists()) {
            $random = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $nik = $kodeWilayah . str_pad($tanggal, 2, '0', STR_PAD_LEFT) . $bulan . $tahun . $random;
        }
        
        return $nik;
    }

    public function identitas()
{
    return $this->hasOne(Identitas::class, 'id_alumni', 'id_alumni');
}
};