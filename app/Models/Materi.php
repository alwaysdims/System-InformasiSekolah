<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['guru_mapel_id', 'judul', 'deskripsi', 'file_path'];

    public function guruMapel()
    {
        return $this->belongsTo(GuruMapel::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'materi_kelas');
    }
}
