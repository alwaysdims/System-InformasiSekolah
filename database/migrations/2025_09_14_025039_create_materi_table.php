<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_mapel_id');
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->string('file_path', 255)->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->foreign('guru_mapel_id')->references('id')->on('guru_mapel')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('materi');
    }
};
