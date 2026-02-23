<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;
use App\Models\Node;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    // ==========================================
    // GET SEMUA PROGRESS MILIK USER YANG LOGIN
    // ==========================================
    public function index(Request $request)
    {
        $user     = $request->user();
        $progress = UserProgress::with('node:id,title,type,order')
            ->where('user_id', $user->id)
            ->get();

        $completedCount = $progress->where('status', 'completed')->count();
        $totalNodes     = Node::count();

        return response()->json([
            'progress'        => $progress,
            'summary' => [
                'completed'       => $completedCount,
                'total'           => $totalNodes,
                'completion_rate' => $totalNodes > 0
                    ? round(($completedCount / $totalNodes) * 100, 1)
                    : 0,
                'total_exp'       => $user->exp_points,
            ],
        ]);
    }

    // ==========================================
    // GET PROGRESS 1 NODE TERTENTU
    // ==========================================
    public function show(Request $request, $nodeId)
    {
        $user     = $request->user();
        $progress = UserProgress::where('user_id', $user->id)
            ->where('node_id', $nodeId)
            ->first();

        if (!$progress) {
            return response()->json([
                'node_id' => $nodeId,
                'status'  => 'locked',
            ]);
        }

        return response()->json([
            'node_id'      => $nodeId,
            'status'       => $progress->status,
            'attempts'     => $progress->attempts,
            'completed_at' => $progress->completed_at,
        ]);
    }
}
