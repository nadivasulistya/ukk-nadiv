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
        Schema::create('tbl_konsentrasi_keahlian', function (Blueprint $table) {
            $table->id('id_konsentrasi_keahlian'); // Membuat kolom id_konsentrasi_keahlian sebagai primary key
            $table->foreignId('id_program_keahlian')->constrained('tbl_program_keahlian', 'id_program_keahlian')->cascadeOnDelete();
            $table->string('kode_konsentrasi_keahlian', 10)->unique();
            $table->string('konsentrasi_keahlian', 100);
            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_konsentrasi_keahlian');
    }
};