<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugas_id');
            $table->text('pertanyaan');
            $table->enum('tipe', ['Pilihan Ganda','Essay']);
            $table->text('pilihan_a')->nullable();
            $table->text('pilihan_b')->nullable();
            $table->text('pilihan_c')->nullable();
            $table->text('pilihan_d')->nullable();
            $table->string('jawaban_benar', 10)->nullable();
            $table->timestamps();

            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas_soal');
    }
};
