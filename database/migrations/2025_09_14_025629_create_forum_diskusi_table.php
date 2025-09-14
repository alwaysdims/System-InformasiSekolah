<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('forum_diskusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_mapel_id');
            $table->string('judul', 150);
            $table->unsignedBigInteger('dibuat_oleh');
            $table->timestamp('dibuat_pada')->useCurrent();

            $table->foreign('guru_mapel_id')->references('id')->on('guru_mapel')->onDelete('cascade');
            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('forum_diskusi');
    }
};
