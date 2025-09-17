<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliMuridSiswa extends Model
{
    protected $table = 'wali_murid_siswa';
    protected $fillable = ['wali_murid_id', 'siswa_id', 'hubungan'];

    public function waliMurid()
    {
        return $this->belongsTo(WaliMurid::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
