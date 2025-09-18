<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    protected $table = 'forum_diskusi';
    protected $fillable = ['guru_mapel_id', 'judul', 'dibuat_oleh'];

    public function guruMapel()
    {
        return $this->belongsTo(Guru_Mapel::class);
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
