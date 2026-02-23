<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tambahkan di dalam class User, setelah bagian $hidden

    // Semua progress node milik user ini
    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    // Progress node yang sudah selesai saja
    public function completedNodes()
    {
        return $this->hasMany(UserProgress::class)
            ->where('status', 'completed');
    }

    // Progress node yang sudah terbuka saja
    public function unlockedNodes()
    {
        return $this->hasMany(UserProgress::class)
            ->whereIn('status', ['unlocked', 'completed']);
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
