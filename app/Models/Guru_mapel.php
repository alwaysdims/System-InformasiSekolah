<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Tugas;
use App\Models\Jurusan;
use App\Models\ForumDiskusi;
use Illuminate\Database\Eloquent\Model;

class Guru_Mapel extends Model
{
    protected $table = 'guru_mapel';
    protected $fillable = ['guru_id', 'mapel_id', 'jurusan_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'guru_mapel_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function forum()
    {
        return $this->hasMany(ForumDiskusi::class, 'guru_mapel_id');
    }
}
