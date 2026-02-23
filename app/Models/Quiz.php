<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'node_id',
        'type',
        'question',
        'options',
        'correct_answer',
        'hint',
        'order',
    ];

    // Otomatis konversi kolom 'options' dari JSON string ke array PHP
    protected $casts = [
        'options' => 'array',
    ];

    // Sembunyikan correct_answer agar tidak ikut terkirim ke Flutter
    // KUNCI ANTI-CHEAT: jawaban tidak pernah dikirim ke HP siswa
    protected $hidden = [
        'correct_answer',
    ];

    // Node pemilik kuis ini
    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    // Method untuk cek jawaban (dipanggil dari Controller)
    public function checkAnswer(string $userAnswer): bool
    {
        // Untuk multiple choice & fill blank: langsung bandingkan
        if ($this->type !== 'arrange_code') {
            return strtolower(trim($userAnswer)) === strtolower(trim($this->correct_answer));
        }

        // Untuk arrange_code: bandingkan urutan index
        // correct_answer = "1,0,2" → user harus kirim "1,0,2" juga
        return trim($userAnswer) === trim($this->correct_answer);
    }
}
