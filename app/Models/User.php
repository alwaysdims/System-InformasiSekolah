<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\WaliMurid;
use App\Models\PengaduanChat;
use App\Models\PelanggaranSiswa;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    const UPDATED_AT = null;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class,'user_id');
    }

    public function waliMurid()
    {
        return $this->hasOne(WaliMurid::class);
    }
    public function guruMapel()
    {
        return $this->hasOneThrough(
            Guru_Mapel::class,
            Guru::class,
            'user_id', // Foreign key on Guru table
            'guru_id', // Foreign key on GuruMapel table
            'id', // Local key on User table
            'id' // Local key on Guru table
        );
    }

    public function komentar()
    {
        return $this->hasMany(ForumKomentar::class);
    }


    public function kalenderPendidikan()
    {
        return $this->hasMany(KalenderPendidikan::class, 'dibuat_oleh');
    }
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    // Relasi ke pelanggaran yang ditangani waka/guru
    public function pelanggaranDitangani()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'ditangani_oleh');
    }

    // Relasi ke pengaduan chat
    public function pengaduanChats()
    {
        return $this->hasMany(PengaduanChat::class, 'user_id');
    }
}
