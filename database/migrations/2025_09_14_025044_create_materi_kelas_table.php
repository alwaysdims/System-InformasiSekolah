<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materi_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->unique(['materi_id', 'kelas_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('materi_kelas');
    }
};
