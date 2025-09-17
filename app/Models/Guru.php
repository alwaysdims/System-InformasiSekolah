<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    //
    public $timestamps = false;
    protected $table = 'guru';
    protected $guarded = [];
    protected $fillable = ['user_id', 'nama', 'nip', 'alamat', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'wali_kelas');
    }
}
