<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NodeController;
use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\ProgressController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ========================
    // PUBLIC (tidak perlu login)
    // ========================
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // ========================
    // PROTECTED (wajib login, pakai Bearer Token)
    // ========================
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/logout',  [AuthController::class, 'logout']);
        Route::get('/profile',  [AuthController::class, 'profile']);

        // Roadmap & Materi
        Route::get('/nodes',      [NodeController::class, 'index']); // Semua node + status
        Route::get('/nodes/{id}', [NodeController::class, 'show']);  // Detail 1 node

        // Kuis
        Route::post('/quiz/{quizId}/answer', [QuizController::class, 'checkAnswer']);

        // Progress
        Route::get('/progress',          [ProgressController::class, 'index']);
        Route::get('/progress/{nodeId}', [ProgressController::class, 'show']);
    });
});
