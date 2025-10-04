<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
<<<<<<< HEAD

    protected $fillable = ['kode_mapel', 'nama_mapel'];
=======
    protected $fillable = ['nama_mapel'];
    // protected $table = 'mapel';
>>>>>>> eda5ed08b53d3be2203b293c625e7f18ae5cea6e

    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel');
    }
}
