<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Model;

class PengaduanChat extends Model
{
    protected $table = 'pengaduan_chat';
    protected $fillable = ['pengaduan_id', 'user_id', 'pesan'];

    public $timestamps = false;

    protected $dates = ['dibuat_pada'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
