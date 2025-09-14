<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaduan_gambar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id');
            $table->string('file_path', 255);
            $table->timestamps();

            $table->foreign('pengaduan_id')->references('id')->on('pengaduan')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('pengaduan_gambar');
    }
};
