<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'title',
        'type',
        'content',
        'x_position',
        'y_position',
        'order',
        'exp_reward',
    ];

    // Relasi ke kuis-kuis yang dimiliki node ini
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    // Relasi ke koneksi keluar dari node ini (node ini → node lain)
    public function outgoingConnections()
    {
        return $this->hasMany(NodeConnection::class, 'source_node_id');
    }

    // Relasi ke koneksi masuk ke node ini (node lain → node ini)
    public function incomingConnections()
    {
        return $this->hasMany(NodeConnection::class, 'target_node_id');
    }

    // Node-node yang akan terbuka setelah node ini selesai
    public function nextNodes()
    {
        return $this->belongsToMany(
            Node::class,
            'node_connections',
            'source_node_id',
            'target_node_id'
        );
    }

    // Node-node yang harus selesai sebelum node ini terbuka
    public function previousNodes()
    {
        return $this->belongsToMany(
            Node::class,
            'node_connections',
            'target_node_id',
            'source_node_id'
        );
    }

    // Progress semua user di node ini
    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
