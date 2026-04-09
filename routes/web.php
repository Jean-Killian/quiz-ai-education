<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\DuelController;
use App\Http\Controllers\MissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard redirection to quizzes
    Route::get('/dashboard', function() {
        return redirect()->route('quizzes.index');
    })->name('dashboard');

    // Quiz routes
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/generate', [\App\Http\Controllers\IAQuizGeneratorController::class, 'showForm'])->name('quizzes.generate');
    Route::post('/quizzes/generate', [\App\Http\Controllers\IAQuizGeneratorController::class, 'generate'])->name('quizzes.generate.post');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/result', [QuizController::class, 'result'])->name('quizzes.result');

    // Leaderboard
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');

    // Mission Logs
    Route::get('/logs', [\App\Http\Controllers\MissionController::class, 'index'])->name('logs');

    // Achievements
    Route::get('/achievements', [\App\Http\Controllers\AchievementController::class, 'index'])->name('achievements');

    // Duels
    Route::get('/duels/create/{user}', [DuelController::class, 'create'])->name('duels.create');
    Route::post('/duels/store', [DuelController::class, 'store'])->name('duels.store');
    Route::get('/duels/{duel}/play', [DuelController::class, 'play'])->name('duels.play');
    Route::post('/duels/{duel}/submit', [DuelController::class, 'submit'])->name('duels.submit');
    Route::get('/duels/{duel}/result', [DuelController::class, 'result'])->name('duels.result');
});

require __DIR__.'/auth.php';
