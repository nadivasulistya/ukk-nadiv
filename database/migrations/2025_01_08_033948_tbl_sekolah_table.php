<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_sekolah', function (Blueprint $table) {
            $table->id('id_sekolah'); // Equivalent to INT AUTO_INCREMENT PRIMARY KEY
            $table->string('npsn', 10)->unique(); // VARCHAR(10) NOT NULL with unique constraint
            $table->string('nss', 20)->nullable(); // VARCHAR(20) nullable
            $table->string('nama_sekolah', 50); // VARCHAR(50) NOT NULL
            $table->string('alamat', 50)->nullable(); // VARCHAR(50) nullable
            $table->string('no_telp', 15)->nullable(); // VARCHAR(15) nullable
            $table->string('website', 50)->nullable(); // VARCHAR(50) nullable
            $table->string('email', 50)->nullable(); // VARCHAR(50) nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sekolah');
    }
};