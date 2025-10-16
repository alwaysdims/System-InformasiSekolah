<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas', 'tingkat', 'jurusan_id', 'wali_kelas_id'];

    // public function siswa()
    // {
    //     return $this->hasMany(Siswa::class);
    // }
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_kelas', 'kelas_id', 'siswa_id')
                    ->withPivot('tahun_ajaran');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function tugas()
    {
        return $this->belongsToMany(Tugas::class, 'tugas_kelas', 'kelas_id', 'tugas_id');
    }
    public function kelas()
{
    return $this->belongsToMany(Kelas::class, 'tugas_kelas', 'tugas_id', 'kelas_id');
}
public function siswaKelas()
{
    return $this->hasMany(SiswaKelas::class, 'kelas_id', 'id');
}


}
