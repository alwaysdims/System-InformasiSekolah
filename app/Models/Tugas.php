<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = ['guru_mapel_id', 'judul', 'deskripsi', 'deadline', 'tipe'];

    public function guruMapel()
    {
        return $this->belongsTo(Guru_Mapel::class, 'guru_mapel_id');
    }

    public function guru() {
        return $this->hasOneThrough(
            Guru::class,
            Guru_mapel::class,
            'id',
            'id',
            'guru_mapel_id',
            'guru_id'
        );
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'tugas_kelas');
    }

    public function soal()
    {
        return $this->hasMany(TugasSoal::class);
    }

    public function jawaban()
    {
        return $this->hasMany(TugasJawaban::class);
    }
}
