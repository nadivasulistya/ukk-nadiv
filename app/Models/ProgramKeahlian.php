<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKeahlian extends Model
{
    protected $table = 'tbl_program_keahlian';
    protected $primaryKey = 'id_program_keahlian';
    
    protected $fillable = [
        'id_bidang_keahlian', 
        'kode_program_keahlian', 
        'program_keahlian'
    ];

    // Relasi ke Bidang Keahlian
    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_bidang_keahlian');
    }

    // Relasi ke Konsentrasi Keahlian
    public function konsentrasiKeahlian()
    {
        return $this->hasMany(KonsentrasiKeahlian::class, 'id_program_keahlian');
    }
}