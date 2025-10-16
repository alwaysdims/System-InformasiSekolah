<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderPendidikan extends Model
{
    use HasFactory;

    protected $table = 'kalender_pendidikan';
    protected $primaryKey = 'id';
    public $timestamps = false; // karena kamu pakai field 'dibuat_pada' manual

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'dibuat_oleh',
        'dibuat_pada',
    ];

    /**
     * Relasi ke model User (yang membuat entri kalender)
     */
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
