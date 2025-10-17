<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ForumKomentar extends Model
{
    protected $table = 'forum_komentar';
    protected $fillable = ['forum_id', 'user_id', 'komentar', 'dibuat_pada'];

    // Nonaktifkan timestamps default (karena kamu pakai field custom)
    public $timestamps = false;

    // Biar bisa pakai diffForHumans() dengan field `dibuat_pada`
    protected $casts = [
        'dibuat_pada' => 'datetime',
    ];

    public function forum()
    {
        return $this->belongsTo(ForumDiskusi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
