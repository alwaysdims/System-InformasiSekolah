<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('soal_id')->nullable();
            $table->text('jawaban')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();

            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('soal_id')->references('id')->on('tugas_soal')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas_jawaban');
    }
};
