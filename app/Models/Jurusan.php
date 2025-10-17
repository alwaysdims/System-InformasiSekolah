<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Guru_mapel;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model

{
    protected $table = 'jurusan';
    protected $fillable = ['kode_jurusan', 'nama_jurusan'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function guruMapel()
    {
        return $this->hasMany(Guru_mapel::class);
    }
}
