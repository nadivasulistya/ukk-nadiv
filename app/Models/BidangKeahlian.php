<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class BidangKeahlian extends Model
{
    protected $table = 'tbl_bidang_keahlian';
    protected $primaryKey = 'id_bidang_keahlian';
    
    protected $fillable = [
        'kode_bidang_keahlian', 
        'bidang_keahlian'
    ];

    // Relationship with Program Keahlian
    public function programKeahlian()
    {
        return $this->hasMany(ProgramKeahlian::class, 'id_bidang_keahlian', 'id_bidang_keahlian');
    }
}