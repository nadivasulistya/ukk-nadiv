<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('raw_student_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nisn', 20)->unique();
            $table->string('nik', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('raw_student_data');
    }
}; 