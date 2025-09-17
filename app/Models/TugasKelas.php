<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasKelas extends Model
{
    protected $table = 'tugas_kelas';
    protected $fillable = ['tugas_id', 'kelas_id'];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
