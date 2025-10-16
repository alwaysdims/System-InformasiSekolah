<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('tugas', 'bobot_pg')) {
                $table->integer('bobot_pg')->nullable()->after('tipe');
            }
            if (!Schema::hasColumn('tugas', 'bobot_esai')) {
                $table->integer('bobot_esai')->nullable()->after('bobot_pg');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['bobot_pg', 'bobot_esai']);
        });
    }
};
