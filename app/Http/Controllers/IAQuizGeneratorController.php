<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Services\QuizAIService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IAQuizGeneratorController extends Controller
{
    public function showForm()
    {
        return view('quizzes.generate');
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:100',
            'count' => 'required|integer|min:1|max:10',
            'answers' => 'required|integer|min:2|max:6',
        ]);

        $prompt = $this->buildPrompt($data['subject'], $data['count'], $data['answers']);
        try {
            $qcm = $this->fetchQuizFromAI($prompt);
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Échec de génération. Détails : " . $e->getMessage());
        }

        if (empty($qcm)) {
            return redirect()->back()->with('error', 'Le quiz généré est vide.');
        }

        // Créer le quiz en BDD
        $quiz = Quiz::create([
            'title' => 'Quiz IA : ' . ucfirst($data['subject']),
            'description' => 'Ce quiz de ' . count($qcm) . ' questions a été généré automatiquement par intelligence artificielle.',
        ]);

        foreach ($qcm as $q) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['question'],
            ]);

            foreach ($q['options'] as $optionText) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $optionText,
                    'is_correct' => ($optionText === $q['answer']),
                ]);
            }
        }

        return redirect()->route('quizzes.index')->with('success', 'Votre quiz a bien été généré par l\'IA !');
    }

    private function buildPrompt(string $subject, int $count, int $answers): string
    {
        return <<<EOT
Tu vas générer un QCM. Tu dois retourner UNIQUEMENT un objet JSON valide, sans la moindre phrase d'introduction ou conclusion.
Le JSON doit avoir une seule clé "quiz" qui contient un tableau.
Sujet: {$subject}.
Il doit contenir exactement {$count} questions.
Chaque question doit avoir {$answers} choix dans "options".
Format strict attendu:
{
  "quiz": [
    {
      "question": "...",
      "options": ["choix 1", "choix 2", ...],
      "answer": "choix correct",
      "difficulty": "facile"
    }
  ]
}
EOT;
    }

    private function fetchQuizFromAI(string $prompt): array
    {
        $ai = new QuizAIService();
        $response = $ai->generateQuestionnaire($prompt);

        // API au format OpenAI met le texte dans cette arborescence
        $content = $response['choices'][0]['message']['content'] ?? '';
        
        $start = strpos($content, '{');
        $end = strrpos($content, '}');
        
        if ($start !== false && $end !== false) {
            $content = substr($content, $start, $end - $start + 1);
        }
        
        $data = json_decode($content, true);
        
        if (!isset($data['quiz']) || !is_array($data['quiz'])) {
            throw new Exception("L'intelligence artificielle a renvoyé un format inattendu. Veuillez réessayer.");
        }
        
        return $data['quiz'];
    }
}
