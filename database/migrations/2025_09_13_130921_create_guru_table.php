<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip', 30)->unique()->nullable();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('jurusan_kuliah', 150)->nullable();
            $table->string('jenis_ptk')->nullable();
            $table->string('status_kepeg')->nullable();
            $table->string('jabatan')->default('Guru Mapel');
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
