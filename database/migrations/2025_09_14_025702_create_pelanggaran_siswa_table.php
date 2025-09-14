<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pelanggaran_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('jenis_pelanggaran', 150)->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->unsignedBigInteger('ditangani_oleh')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('ditangani_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('pelanggaran_siswa');
    }
};
