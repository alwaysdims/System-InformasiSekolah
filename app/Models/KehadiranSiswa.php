<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranSiswa extends Model
{
    protected $table = 'kehadiran_siswa';
    protected $guarded = [];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
