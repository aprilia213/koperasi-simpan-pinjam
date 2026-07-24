<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Simpanan;
use App\Models\Pinjaman;

#[Fillable([
    'name',
    'email',
    'password',
    'role',

    // Profil Anggota
    'nik',
    'no_hp',
    'alamat',
    'pekerjaan',
    'nama_bank',
    'nomor_rekening',
    'nama_pemilik_rekening',
    'foto_ktp',
    'status_profil',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user memiliki role admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user memiliki role user.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Relasi Simpanan
     */
    public function simpanan()
    {
        return $this->hasOne(Simpanan::class);
    }

    /**
     * Relasi Pinjaman
     */
    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class);
    }

    /**
     * Cek apakah profil sudah diverifikasi admin.
     */
    public function profilTerverifikasi(): bool
    {
        return $this->status_profil === 'verified';
    }

    /**
     * Cek apakah profil masih menunggu verifikasi.
     */
    public function profilPending(): bool
    {
        return $this->status_profil === 'pending';
    }

    /**
     * Cek apakah profil ditolak admin.
     */
    public function profilDitolak(): bool
    {
        return $this->status_profil === 'rejected';
    }
}