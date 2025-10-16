<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tugas extends Model
{
    protected $fillable = [
        'guru_mapel_id', 'judul', 'deskripsi', 'deadline', 'tipe',
        'durasi', 'bobot_pg', 'bobot_esai', 'publish_time'
    ];

    protected $casts = [
        'publish_time' => 'datetime',
        'deadline' => 'datetime',
        'durasi' => 'integer',
        'bobot_pg' => 'integer',
        'bobot_esai' => 'integer',
    ];

    public $timestamps = false;
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

    public function isPublished()
    {
        return $this->publish_time && $this->publish_time->lte(Carbon::now()) && $this->kelas->isNotEmpty();
    }
}
