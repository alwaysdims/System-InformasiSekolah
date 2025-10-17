<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class PelanggaranSiswa extends Model
{
    protected $table = 'pelanggaran_siswa';
    protected $fillable = ['siswa_id', 'jenis_pelanggaran', 'keterangan', 'tanggal', 'ditangani_oleh'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ditanganiOleh()
    {
        return $this->belongsTo(Guru::class, 'ditangani_oleh', 'id');
    }
}
