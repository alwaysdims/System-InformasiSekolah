<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model

{
    protected $table = 'jurusan';
    protected $fillable = ['kode_jurusan', 'nama_jurusan'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
