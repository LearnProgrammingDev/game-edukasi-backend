<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\NodeConnection;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    // ==========================================
    // GET SEMUA NODE + STATUS UNTUK USER INI
    // Dipanggil Flutter saat render peta roadmap
    // ==========================================
    public function index(Request $request)
    {
        $user  = $request->user();
        $nodes = Node::with(['quizzes:id,node_id,type,question,order'])
            ->orderBy('order')
            ->get();

        // Ambil semua progress user ini sekaligus (efisien, 1 query saja)
        $userProgressMap = UserProgress::where('user_id', $user->id)
            ->pluck('status', 'node_id');

        // Gabungkan status ke setiap node
        $nodes->transform(function ($node) use ($userProgressMap) {
            $node->status = $userProgressMap[$node->id] ?? 'locked';
            return $node;
        });

        // Ambil semua koneksi untuk menggambar garis di peta Flutter
        $connections = NodeConnection::select('source_node_id', 'target_node_id')->get();

        return response()->json([
            'nodes'       => $nodes,
            'connections' => $connections,
        ]);
    }

    // ==========================================
    // GET DETAIL 1 NODE (isi materi lengkap)
    // Dipanggil saat siswa klik node dan masuk ke halaman materi
    // ==========================================
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $node = Node::with(['quizzes' => function ($query) {
            // Jangan ikutkan correct_answer (sudah di-hidden di Model)
            $query->orderBy('order');
        }])
            ->findOrFail($id);

        // Cek apakah user punya akses ke node ini
        $progress = UserProgress::where('user_id', $user->id)
            ->where('node_id', $id)
            ->first();

        if (!$progress || $progress->status === 'locked') {
            return response()->json([
                'message' => 'Node ini masih terkunci! Selesaikan level sebelumnya dulu.',
            ], 403);
        }

        $node->status   = $progress->status;
        $node->attempts = $progress->attempts;

        return response()->json([
            'node' => $node,
        ]);
    }
}
