<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('kalender_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 20); // contoh: 2024/2025
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('kegiatan', 150); // contoh: Ujian Akhir Semester
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->foreignId('dibuat_oleh')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamp('dibuat_pada')->useCurrent();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalender_pendidikan');
    }
};
