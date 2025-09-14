<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('guru_mapel_id');
            $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('guru_mapel_id')->references('id')->on('guru_mapel')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
