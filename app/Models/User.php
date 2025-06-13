<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nomorhp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'gender',
        'foto',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Tambahkan relasi homestays
    public function homestays()
    {
        return $this->hasMany(Homestay::class);
    }

    // Helper method untuk cek role
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Helper method untuk mendapatkan homestays dengan safe checking
    public function getHomestaysAttribute()
    {
        return $this->homestays();
    }
}
