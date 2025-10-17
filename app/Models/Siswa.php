<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id', 'nis', 'nama', 'alamat', 'no_hp', 'kelas_id', 'jurusan_id'];
    // protected $table = 'siswa';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function waliMurid()
    {
        return $this->belongsToMany(WaliMurid::class, 'wali_murid_siswa');
    }
    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class);
    }

    // public function kelas()
    // {
    //     return $this->belongsToMany(Kelas::class, 'siswa_kelas', 'siswa_id', 'kelas_id');
    // }

    public function tugasJawaban()
    {
        return $this->hasMany(TugasJawaban::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'siswa_kelas', 'siswa_id', 'kelas_id')
                    ->withPivot('tahun_ajaran');
    }


}
