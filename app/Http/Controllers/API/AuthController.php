<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ==========================================
    // REGISTER
    // ==========================================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // butuh password_confirmation
        ]);

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => bcrypt($validated['password']),
            'role'       => 'student',
            'exp_points' => 0,
        ]);

        // Otomatis unlock Node pertama (node dengan order = 1)
        $firstNode = Node::where('order', 1)->first();
        if ($firstNode) {
            UserProgress::create([
                'user_id' => $user->id,
                'node_id' => $firstNode->id,
                'status'  => 'unlocked',
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil! Selamat datang, ' . $user->name,
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }

    // ==========================================
    // LOGIN
    // ==========================================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email atau password salah!',
            ], 401);
        }

        $user  = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // ==========================================
    // LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        // Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil!',
        ]);
    }

    // ==========================================
    // PROFILE (data user yang sedang login)
    // ==========================================
    public function profile(Request $request)
    {
        $user = $request->user();

        // Hitung jumlah node yang sudah selesai
        $completedCount = $user->completedNodes()->count();
        $totalNodes     = Node::count();

        return response()->json([
            'user'            => $user,
            'completed_nodes' => $completedCount,
            'total_nodes'     => $totalNodes,
            'completion_rate' => $totalNodes > 0
                ? round(($completedCount / $totalNodes) * 100, 1)
                : 0,
        ]);
    }
}
