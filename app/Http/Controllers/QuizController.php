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

        // On passe les réponses à la session pour l'affichage des résultats
        return redirect()->route('quizzes.result', $quiz->id)->with('user_answers', $submittedAnswers);
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
