<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'node_id',
        'status',
        'attempts',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    // User pemilik progress ini
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Node yang di-track progress-nya
    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    // Helper: cek apakah node ini sudah selesai
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Helper: cek apakah node ini sudah terbuka (bisa diakses)
    public function isUnlocked(): bool
    {
        return in_array($this->status, ['unlocked', 'completed']);
    }
}
