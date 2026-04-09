<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Affiche la liste des quiz disponibles pour l'utilisateur.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $quizzes = Quiz::all();
        // Pour afficher facilement les scores si l'utilisateur a déjà passé le quiz
        $userQuizzes = Auth::user()->quizzes->keyBy('id'); 
        
        return view('quizzes.index', compact('quizzes', 'userQuizzes'));
    }

    /**
     * Affiche le formulaire d'un quiz spécifique.
     * 
     * @param Quiz $quiz
     * @return \Illuminate\View\View
     */
    public function show(Quiz $quiz)
    {
        // On charge les questions avec leurs réponses pour éviter le problème N+1
        $quiz->load('questions.answers');
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Calcule le score final de la tentative et sauvegarde le résultat.
     * 
     * @param Request $request
     * @param Quiz $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $score = 0;
        
        // Les réponses sont envoyées via un tableau $request->answers
        // où la clé est l'ID de la question et la valeur est l'ID de la réponse
        $submittedAnswers = $request->input('answers', []);

        foreach ($submittedAnswers as $questionId => $answerId) {
            $answer = Answer::find($answerId);
            if ($answer && $answer->is_correct) {
                $score++;
            }
        }

        // Sauvegarder le score pour l'utilisateur via la table pivot
        Auth::user()->quizzes()->sync([
            $quiz->id => ['score' => $score]
        ], false);

        // --- CALCUL DU SCORE GLOBAL (Points d'XP) ---
        $totalQuestions = $quiz->questions()->count();
        $isPerfect = ($score === $totalQuestions && $totalQuestions > 0);

        // --- GESTION DES STREAKS (SÉRIES) ---
        $user = Auth::user();
        if ($isPerfect) {
            $user->current_streak += 1;
            if ($user->current_streak > $user->max_streak) {
                $user->max_streak = $user->current_streak;
            }
        } else {
            $user->current_streak = 0;
        }

        // Attribution des points de base selon la difficulté du quiz
        $pointsPerBug = match($quiz->difficulty) {
            'Junior' => 10,
            'Medior' => 25,
            'Senior' => 50,
            default  => 10
        };

        $basePoints = $score * $pointsPerBug;
        
        // Multiplicateur de Streak (Bonus de 10% par point de streak, max 2.0x soit 200%)
        $streakMultiplier = min(2, 1 + ($user->current_streak * 0.1));
        $gainedPoints = floor($basePoints * $streakMultiplier);

        // Bonus Perfect supplémentaire (1.2x)
        if ($isPerfect) {
            $gainedPoints = floor($gainedPoints * 1.2);
        }

        // Mise à jour du score global cumulé de l'utilisateur (Leaderboard)
        $user->global_score += $gainedPoints;
        $user->save();

        // --- DÉBLOCAGE DE BADGES ---
        $unlockedBadgeIds = [];
        
        // Badge: First Blood (Première réussite)
        if ($score > 0) {
            $this->unlockBadge($user, 'First Blood', $unlockedBadgeIds);
        }

        // Badge: Zero Day Finder (Senior Perfect)
        if ($isPerfect && $quiz->difficulty === 'Senior') {
            $this->unlockBadge($user, 'Zero Day Finder', $unlockedBadgeIds);
        }

        // Badge: Overclocker (Série de 5)
        if ($user->current_streak >= 5) {
            $this->unlockBadge($user, 'Overclocker', $unlockedBadgeIds);
        }

        // Badge: Ghost in the Machine (1000 XP cumulés)
        if ($user->global_score >= 1000) {
            $this->unlockBadge($user, 'Ghost in the Machine', $unlockedBadgeIds);
        }

        // On passe les réponses, le gain de points et les badges à la session pour l'affichage
        return redirect()->route('quizzes.result', $quiz->id)
            ->with('user_answers', $submittedAnswers)
            ->with('gained_points', $gainedPoints)
            ->with('unlocked_badges', $unlockedBadgeIds);
    }

    protected function unlockBadge($user, $badgeName, &$unlockedBadgeIds)
    {
        $badge = Badge::where('name', $badgeName)->first();
        if ($badge && !$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id);
            $unlockedBadgeIds[] = $badge->name;
        }
    }

    /**
     * Affiche le résultat détaillé d'un quiz après soumission.
     * 
     * @param Quiz $quiz
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function result(Quiz $quiz)
    {
        // Récupération du score stocké dans la table pivot quiz_user
        $userQuiz = Auth::user()->quizzes()->where('quiz_id', $quiz->id)->first();
        
        if (!$userQuiz) {
            return redirect()->route('quizzes.index')->with('error', "Vous n'avez pas encore passé ce quiz.");
        }

        $score = $userQuiz->pivot->score;
        $totalQuestions = $quiz->questions()->count();

        // Chargement pour la correction détaillée
        $quiz->load('questions.answers');

        return view('quizzes.result', compact('quiz', 'score', 'totalQuestions'));
    }
}
