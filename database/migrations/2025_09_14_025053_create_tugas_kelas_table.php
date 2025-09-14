<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tugas_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugas_id');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->unique(['tugas_id', 'kelas_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('tugas_kelas');
    }
};
