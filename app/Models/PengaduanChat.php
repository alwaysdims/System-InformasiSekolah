<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanChat extends Model
{
    protected $table = 'pengaduan_chat';
    protected $fillable = ['pengaduan_id', 'user_id', 'pesan'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
