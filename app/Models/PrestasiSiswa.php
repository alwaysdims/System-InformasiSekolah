<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    protected $table = 'prestasi_siswa';
    protected $guarded = [];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
