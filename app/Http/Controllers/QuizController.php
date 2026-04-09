<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
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
        // Attribution des points selon la difficulté du quiz
        $pointsPerBug = match($quiz->difficulty) {
            'Junior' => 10,
            'Medior' => 25,
            'Senior' => 50,
            default  => 10
        };

        $totalQuestions = $quiz->questions()->count();
        $gainedPoints = $score * $pointsPerBug;

        // Bonus Perfect (100% correct) : +20% de points
        if ($score === $totalQuestions && $totalQuestions > 0) {
            $gainedPoints = floor($gainedPoints * 1.2);
        }

        // Mise à jour du score global cumulé de l'utilisateur (Leaderboard)
        $user = Auth::user();
        $user->global_score += $gainedPoints;
        $user->save();

        // On passe les réponses et le gain de points à la session pour l'affichage des résultats
        return redirect()->route('quizzes.result', $quiz->id)
            ->with('user_answers', $submittedAnswers)
            ->with('gained_points', $gainedPoints);
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
