<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru_Mapel extends Model
{
    protected $table = 'guru_mapel';
    protected $fillable = ['guru_id', 'mapel_id', 'jurusan_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

}
