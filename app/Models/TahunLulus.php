<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunLulus extends Model
{
    protected $table = 'tbl_tahun_lulus';
    protected $primaryKey = 'id_tahun_lulus';
    protected $fillable = [
        'tahun_lulus',
        'keterangan',
    ];

    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_tahun_lulus', 'id_tahun_lulus');
    }
}
