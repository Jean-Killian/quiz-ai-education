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
        $allowedSubjects = ['PHP', 'JavaScript', 'Python', 'Java', 'C#', 'C++', 'Go', 'Rust', 'SQL', 'React', 'TypeScript'];

        $data = $request->validate([
            'subject' => 'required|string|in:' . implode(',', $allowedSubjects),
            'difficulty' => 'required|string|in:Junior,Medior,Senior',
            'count' => 'required|integer|min:1|max:10',
            'answers' => 'required|integer|min:2|max:6',
        ]);

        $prompt = $this->buildPrompt($data['subject'], $data['difficulty'], $data['count'], $data['answers']);
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
            'title' => 'Code Review [' . $data['difficulty'] . '] : ' . ucfirst($data['subject']),
            'description' => "Mission de débogage contenant " . count($qcm) . " failles ou erreurs générées par IA.",
            'difficulty' => $data['difficulty'],
        ]);

        foreach ($qcm as $q) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['question'],
                'explanation' => $q['explanation'] ?? null,
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

    private function buildPrompt(string $subject, string $difficulty, int $count, int $answers): string
    {
        return <<<EOT
Tu vas générer une mission de Code Review (Chasse aux Bugs). Tu dois retourner UNIQUEMENT un objet JSON valide, sans conversation.
Le JSON doit avoir une seule clé "quiz" qui contient un tableau.
Langage de programmation ou Framework : {$subject}.
Difficulté : {$difficulty}.

Mission : Génère exactement {$count} cas de code review.
Pour chaque cas, la "question" doit impérativement être un bloc de code formaté en Markdown (ex: ```php ... ```) contenant UN bug caché, une faille de sécurité ou un Code Smell.
Il doit y avoir exactement {$answers} propositions de correction (patches) dans "options".

Format strict attendu:
{
  "quiz": [
    {
      "question": "```\\n// Code avec bug ici\\n```",
      "options": ["Patch 1", "Patch 2", ...],
      "answer": "La solution exacte parmi les options",
      "explanation": "Brève explication pédagogique du bug et de la solution.",
      "difficulty": "{$difficulty}"
    }
  ]
}
EOT;
    }

    private function fetchQuizFromAI(string $prompt): array
    {
        $gemini = new QuizAIService();
        $response = $gemini->generateQuestionnaire($prompt);

        // Format OpenAI / Groq
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
