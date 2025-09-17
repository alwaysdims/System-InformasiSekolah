<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanGambar extends Model
{
    protected $table = 'pengaduan_gambar';
    protected $fillable = ['pengaduan_id', 'file_path'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
