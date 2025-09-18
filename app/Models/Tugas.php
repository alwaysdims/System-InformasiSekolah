<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = ['guru_mapel_id', 'judul', 'deskripsi', 'deadline', 'tipe'];

    public function guruMapel()
    {
        return $this->belongsTo(Guru_Mapel::class);
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
