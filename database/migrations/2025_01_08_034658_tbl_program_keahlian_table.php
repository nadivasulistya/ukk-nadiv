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
        Schema::create('tbl_program_keahlian', function (Blueprint $table) {
            $table->id('id_program_keahlian'); 
            $table->unsignedBigInteger('id_bidang_keahlian');// Ini akan membuat kolom id dengan tipe BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('kode_program_keahlian', 10)->unique(); // Kolom kode_program_keahlian dengan panjang 10 dan unique
            $table->string('program_keahlian', 100); // Kolom program_keahlian dengan panjang 100
            $table->timestamps(); // Opsional: menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel jika migrasi di-rollback
        Schema::dropIfExists('tbl_program_keahlian');
    }
};