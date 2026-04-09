<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\DuelController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\IAQuizGeneratorController;
use Illuminate\Support\Facades\Route;

/**
 * 🛰️ ROUTES DU RÉSEAU BUG_HUNTER
 */

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes sécurisées (Authentification requise)
Route::middleware('auth')->group(function () {
    
    // GESTION DU PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard redirection vers les missions
    Route::get('/dashboard', function() {
        return redirect()->route('quizzes.index');
    })->name('dashboard');

    // SYSTÈME DE MISSIONS (QUIZ)
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/generate', [IAQuizGeneratorController::class, 'showForm'])->name('quizzes.generate');
    Route::post('/quizzes/generate', [IAQuizGeneratorController::class, 'generate'])->name('quizzes.generate.post');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/result', [QuizController::class, 'result'])->name('quizzes.result');

    // CLASSEMENT (LEADERBOARD)
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // HISTORIQUE DES MISSIONS (LOGS)
    Route::get('/logs', [MissionController::class, 'index'])->name('logs');

    // SUCCÈS & RÉCOMPENSES (ACHIEVEMENTS)
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements');

    // SYSTÈME DE DUELS ASYNCHRONES
    Route::group(['prefix' => 'duels', 'as' => 'duels.'], function() {
        Route::get('/create/{user}', [DuelController::class, 'create'])->name('create');
        Route::post('/store', [DuelController::class, 'store'])->name('store');
        Route::get('/{duel}/play', [DuelController::class, 'play'])->name('play');
        Route::post('/{duel}/submit', [DuelController::class, 'submit'])->name('submit');
        Route::get('/{duel}/result', [DuelController::class, 'result'])->name('result');
    });
});

require __DIR__.'/auth.php';
