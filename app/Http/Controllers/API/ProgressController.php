<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;
use App\Models\Node;
use App\Models\NodeConnection;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    // =============================================
    // GET SEMUA PROGRESS MILIK USER
    // =============================================
    public function index(Request $request)
    {
        $user     = $request->user();
        $progress = UserProgress::with('node:id,title,type,order')
            ->where('user_id', $user->id)
            ->get();

        $completedCount = $progress->where('status', 'completed')->count();
        $totalNodes     = Node::count();

        return response()->json([
            'progress' => $progress,
            'summary'  => [
                'completed'       => $completedCount,
                'total'           => $totalNodes,
                'completion_rate' => $totalNodes > 0
                    ? round(($completedCount / $totalNodes) * 100, 1)
                    : 0,
                'total_exp'       => $user->exp_points,
            ],
        ]);
    }

    // =============================================
    // GET PROGRESS 1 NODE
    // =============================================
    public function show(Request $request, $nodeId)
    {
        $user     = $request->user();
        $progress = UserProgress::where('user_id', $user->id)
            ->where('node_id', $nodeId)
            ->first();

        if (!$progress) {
            return response()->json(['node_id' => $nodeId, 'status' => 'locked']);
        }

        return response()->json([
            'node_id'      => $nodeId,
            'status'       => $progress->status,
            'attempts'     => $progress->attempts,
            'completed_at' => $progress->completed_at,
        ]);
    }

    // =============================================
    // COMPLETE NODE MATERI
    // Dipanggil saat user klik "Selesai Membaca"
    // =============================================
    public function completeMateri(Request $request, $nodeId)
    {
        $user = $request->user();
        $node = Node::findOrFail($nodeId);

        // Hanya untuk node tipe materi
        if ($node->type !== 'materi') {
            return response()->json([
                'message' => 'Endpoint ini hanya untuk node materi!',
            ], 400);
        }

        // Cek apakah node ini sudah di-unlock
        $progress = UserProgress::where('user_id', $user->id)
            ->where('node_id', $nodeId)
            ->first();

        if (!$progress || $progress->status === 'locked') {
            return response()->json([
                'message' => 'Node ini belum terbuka!',
            ], 403);
        }

        // Kalau sudah completed sebelumnya, tidak perlu proses lagi
        if ($progress->status === 'completed') {
            return response()->json([
                'message'        => 'Node ini sudah diselesaikan sebelumnya.',
                'already_done'   => true,
                'unlocked_nodes' => $this->getNextNodes($user->id, $nodeId),
                'total_exp'      => $user->exp_points,
            ]);
        }

        // Tandai selesai
        $progress->update([
            'status'       => 'completed',
            'completed_at' => now(),
        ]);

        // Beri EXP ke user
        $user->increment('exp_points', $node->exp_reward);

        // Buka node-node berikutnya
        $connections = NodeConnection::where('source_node_id', $nodeId)->get();
        foreach ($connections as $connection) {
            UserProgress::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'node_id' => $connection->target_node_id,
                ],
                ['status' => 'unlocked']
            );
        }

        return response()->json([
            'message'        => 'Materi selesai dibaca! EXP bertambah 🎉',
            'exp_gained'     => $node->exp_reward,
            'total_exp'      => $user->fresh()->exp_points,
            'unlocked_nodes' => $this->getNextNodes($user->id, $nodeId),
        ]);
    }

    // Helper: ambil ID node yang baru terbuka
    private function getNextNodes($userId, $completedNodeId): array
    {
        return NodeConnection::where('source_node_id', $completedNodeId)
            ->pluck('target_node_id')
            ->toArray();
    }
}
