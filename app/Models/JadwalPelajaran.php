<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    protected $fillable = ['kelas_id', 'guru_mapel_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guruMapel()
    {
        return $this->belongsTo(Guru_Mapel::class);
    }
}
