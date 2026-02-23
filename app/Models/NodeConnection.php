<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeConnection extends Model
{
    protected $fillable = [
        'source_node_id',
        'target_node_id',
    ];

    // Node asal (harus diselesaikan dulu)
    public function sourceNode()
    {
        return $this->belongsTo(Node::class, 'source_node_id');
    }

    // Node tujuan (yang akan terbuka)
    public function targetNode()
    {
        return $this->belongsTo(Node::class, 'target_node_id');
    }
}
