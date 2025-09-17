<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasJawaban extends Model
{
    protected $table = 'tugas_jawaban';
    protected $fillable = ['tugas_id', 'siswa_id', 'soal_id', 'jawaban', 'nilai'];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function soal()
    {
        return $this->belongsTo(TugasSoal::class, 'soal_id');
    }
}
