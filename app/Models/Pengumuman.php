<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['judul', 'isi', 'dibuat_oleh'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
