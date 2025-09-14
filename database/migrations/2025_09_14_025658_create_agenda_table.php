<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->unsignedBigInteger('dibuat_oleh');
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('agenda');
    }
};
