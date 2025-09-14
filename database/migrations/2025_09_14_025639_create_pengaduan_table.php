<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('judul', 150);
            $table->text('isi');
            $table->enum('status', ['Menunggu','Diproses','Selesai'])->default('Menunggu');
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('pengaduan');
    }
};
