<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'tbl_sekolah';
    protected $primaryKey = 'id_sekolah';
    public $timestamps = false; // Jika Anda tidak menggunakan timestamps

    protected $fillable = [
        'npsn', 
        'nss', 
        'nama_sekolah', 
        'alamat', 
        'no_telp', 
        'website', 
        'email'
    ];

    // Optional: Custom methods if needed
    public function getSekolahWithDetails($id = null)
    {
        if ($id === null) {
            return $this->all(); // Menggunakan Eloquent untuk mengambil semua data
        }
        return $this->find($id); // Menggunakan Eloquent untuk menemukan berdasarkan ID
    }
}
