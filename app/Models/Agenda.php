<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'dibuat_oleh'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
