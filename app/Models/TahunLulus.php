<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunLulus extends Model
{
    // Nama tabel yang sesuai dengan struktur database
    protected $table = 'tbl_tahun_lulus';
    
    // Primary key custom untuk tabel ini
    protected $primaryKey = 'id_tahun_lulus';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'tahun_lulus', 
        'keterangan'
    ];

    // Relasi dengan tabel Alumni
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_tahun_lulus', 'id_tahun_lulus');
    }
}