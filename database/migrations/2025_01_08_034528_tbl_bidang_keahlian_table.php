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
        Schema::create('tbl_bidang_keahlian', function (Blueprint $table) {
            $table->id('id_bidang_keahlian'); // Menggunakan method id() untuk primary key auto increment
            $table->string('kode_bidang_keahlian', 10)->unique(); // Menghilangkan spasi dan menambahkan unique constraint
            $table->string('bidang_keahlian', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel jika migrasi di-rollback
        Schema::dropIfExists('tbl_bidang_keahlian');
    }
};