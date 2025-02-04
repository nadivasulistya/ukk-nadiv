<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAlumni extends Model
{
    protected $table = 'tbl_status_alumni';
    protected $primaryKey = 'id_status_alumni';

    protected $fillable = [
        'status'  // ini sudah benar sesuai dengan migration
    ];

    // Relasi dengan tabel Alumni
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_status_alumni', 'id_status_alumni');
    }
}