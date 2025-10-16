<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasSoal extends Model
{
    protected $table = 'tugas_soal';
    protected $fillable = [
        'tugas_id', 'pertanyaan', 'tipe',
        'pilihan_a','pilihan_b','pilihan_c','pilihan_d',
        'jawaban_benar'
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    // public function opsi()
    // {
    //     return $this->hasMany(TugasJawaban::class);
    // }


    // public function tugas()
    // {
    //     return $this->belongsTo(Tugas::class);
    // }

    public function jawaban()
    {
        return $this->hasMany(TugasJawaban::class, 'soal_id', 'id');
    }

    protected $casts = [
        'pilihan' => 'array', // If pilihan is stored as JSON
    ];

}
