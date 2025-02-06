<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawStudentData extends Model
{
    protected $table = 'raw_student_data';
    
    protected $fillable = [
        'name',
        'nisn',
        'nik'
    ];
} 