<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas', 'tingkat', 'jurusan_id', 'wali_kelas_id'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }
}
