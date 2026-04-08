<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Afficher la liste des quiz
    public function index()
    {
        $quizzes = Quiz::all();
        // Pour afficher facilement les scores si l'utilisateur a déjà passé le quiz
        $userQuizzes = Auth::user()->quizzes->keyBy('id'); 
        
        return view('quizzes.index', compact('quizzes', 'userQuizzes'));
    }

    // Afficher le formulaire pour un quiz spécifique
    public function show(Quiz $quiz)
    {
        // On charge les questions avec leurs réponses pour éviter le problème N+1
        $quiz->load('questions.answers');
        return view('quizzes.show', compact('quiz'));
    }

    // Calculer le score et le sauvegarder
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

        // Sauvegarder le score pour l'utilisateur
        // 'false' indique qu'on ne détache pas les autres quiz (équivalent syncWithoutDetaching avec mise à jour du score)
        Auth::user()->quizzes()->sync([
            $quiz->id => ['score' => $score]
        ], false);

        // Rediriger vers la page de résultat
        return redirect()->route('quizzes.result', $quiz->id);
    }

    // Afficher le résultat du quiz passé
    public function result(Quiz $quiz)
    {
        // On récupère la donnée pivot (le score)
        $userQuiz = Auth::user()->quizzes()->where('quiz_id', $quiz->id)->first();
        
        if (!$userQuiz) {
            return redirect()->route('quizzes.index')->with('error', "Vous n'avez pas encore passé ce quiz.");
        }

        $score = $userQuiz->pivot->score;
        $totalQuestions = $quiz->questions()->count();

        return view('quizzes.result', compact('quiz', 'score', 'totalQuestions'));
    }
}
