<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\UserProgress;
use App\Models\NodeConnection;
// use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // ==========================================
    // CEK JAWABAN KUIS
    // ANTI-CHEAT: semua validasi dilakukan di sini, bukan di Flutter
    // ==========================================
    public function checkAnswer(Request $request, $quizId)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $user = $request->user();
        $quiz = Quiz::findOrFail($quizId);

        // Pastikan user punya akses ke node ini (anti lompat level)
        $progress = UserProgress::where('user_id', $user->id)
            ->where('node_id', $quiz->node_id)
            ->first();

        if (!$progress || $progress->status === 'locked') {
            return response()->json([
                'message' => 'Kamu tidak punya akses ke kuis ini!',
            ], 403);
        }

        // Tambah counter percobaan
        $progress->increment('attempts');

        // CEK JAWABAN (logic ada di dalam Model Quiz)
        $isCorrect = $quiz->checkAnswer($request->answer);

        if (!$isCorrect) {
            return response()->json([
                'correct' => false,
                'message' => 'Jawaban salah, coba lagi!',
                'hint'    => $progress->attempts >= 3 ? $quiz->hint : null,
                // Hint baru muncul setelah 3x salah
                'attempts' => $progress->attempts,
            ]);
        }

        // ---- JAWABAN BENAR ----

        // Cek apakah ini kuis terakhir di node ini
        $totalQuizzes     = Quiz::where('node_id', $quiz->node_id)->count();
        $isLastQuiz       = $quiz->order >= $totalQuizzes;

        $response = [
            'correct'  => true,
            'message'  => 'Jawaban benar! 🎉',
            'is_last_quiz' => $isLastQuiz,
        ];

        // Kalau ini kuis terakhir → selesaikan node & buka node berikutnya
        if ($isLastQuiz && $progress->status !== 'completed') {
            $this->completeNodeAndUnlockNext($user, $quiz->node_id, $progress);

            $response['node_completed'] = true;
            $response['exp_gained']     = $this->getNodeExpReward($quiz->node_id);
            $response['total_exp']      = $user->fresh()->exp_points;
            $response['unlocked_nodes'] = $this->getNewlyUnlockedNodes($user, $quiz->node_id);
        }

        return response()->json($response);
    }

    // ==========================================
    // PRIVATE HELPERS
    // ==========================================

    private function completeNodeAndUnlockNext($user, $nodeId, $progress)
    {
        // 1. Tandai node ini selesai
        $progress->update([
            'status'       => 'completed',
            'completed_at' => now(),
        ]);

        // 2. Beri EXP ke user
        $expReward = $this->getNodeExpReward($nodeId);
        $user->increment('exp_points', $expReward);

        // 3. Buka node-node berikutnya
        $connections = NodeConnection::where('source_node_id', $nodeId)->get();
        foreach ($connections as $connection) {
            UserProgress::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'node_id' => $connection->target_node_id,
                ],
                [
                    'status' => 'unlocked',
                ]
            );
        }
    }

    private function getNodeExpReward($nodeId): int
    {
        return \App\Models\Node::where('id', $nodeId)->value('exp_reward') ?? 100;
    }

    private function getNewlyUnlockedNodes($user, $completedNodeId): array
    {
        // Kembalikan ID node yang baru saja terbuka
        // Dipakai Flutter untuk animasi gembok terbuka
        $connections = NodeConnection::where('source_node_id', $completedNodeId)
            ->pluck('target_node_id');

        return $connections->toArray();
    }
}
