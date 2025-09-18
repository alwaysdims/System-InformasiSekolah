<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    protected $table = 'wali_murid';
    protected $fillable = ['user_id', 'nama', 'no_hp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'wali_murid_siswa');
    }
}
