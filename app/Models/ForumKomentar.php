<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumKomentar extends Model
{
    protected $table = 'forum_komentar';
    protected $fillable = ['forum_id', 'user_id', 'komentar'];

    public function forum()
    {
        return $this->belongsTo(ForumDiskusi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
