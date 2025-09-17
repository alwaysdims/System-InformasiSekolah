<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriKelas extends Model
{
    protected $table = 'materi_kelas';
    protected $fillable = ['materi_id', 'kelas_id'];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
