<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guru_mapel;
use App\Models\ForumKomentar;
use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    protected $table = 'forum_diskusi';
    protected $fillable = ['guru_mapel_id', 'judul', 'dibuat_oleh'];



    // 👇 Tambahkan ini agar 'dibuat_pada' dianggap datetime oleh Laravel
    protected $casts = [
        'dibuat_pada' => 'datetime',
    ];

    public function guruMapel()
    {
        return $this->belongsTo(Guru_mapel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function komentar()
    {
        return $this->hasMany(ForumKomentar::class, 'forum_id');
    }
}
