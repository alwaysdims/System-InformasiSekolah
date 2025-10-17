<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    
    protected $fillable = ['siswa_id', 'judul', 'isi', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function gambar()
    {
        return $this->hasMany(PengaduanGambar::class);
    }

    public function chat()
    {
        return $this->hasMany(PengaduanChat::class);
    }
}
