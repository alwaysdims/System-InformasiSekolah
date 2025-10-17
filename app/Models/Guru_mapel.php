<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru_Mapel extends Model
{
    protected $table = 'guru_mapel';
    protected $fillable = ['guru_id', 'mapel_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'guru_mapel_id');
    }
}
