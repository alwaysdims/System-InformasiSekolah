<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'dibuat_oleh'];
    protected $table = 'agenda';
    public $timestamp = false;

    public function creator()
    {
        return $this->belongsTo(Guru::class, 'dibuat_oleh', 'id');
    }
}
