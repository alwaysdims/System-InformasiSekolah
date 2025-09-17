<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    protected $table = 'siswa_kelas';
    protected $fillable = ['siswa_id', 'kelas_id', 'tahun_ajaran'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
