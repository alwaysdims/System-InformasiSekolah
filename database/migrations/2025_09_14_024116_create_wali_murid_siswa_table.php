<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wali_murid_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wali_murid_id');
            $table->unsignedBigInteger('siswa_id');
            $table->string('hubungan', 50)->nullable(); // Ayah, Ibu, Wali
            $table->timestamps();

            $table->foreign('wali_murid_id')
                ->references('id')->on('wali_murid')
                ->onDelete('cascade');

            $table->foreign('siswa_id')
                ->references('id')->on('siswa')
                ->onDelete('cascade');

            $table->unique(['wali_murid_id', 'siswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wali_murid_siswa');
    }
};
