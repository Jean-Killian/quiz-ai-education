<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Hash;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer un utilisateur de test
        User::create([
            'name' => 'Utilisateur Test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Créer le quiz
        $quiz = Quiz::create([
            'title' => 'Quiz Laravel pour Débutants',
            'description' => 'Testez vos connaissances de base sur le framework PHP Laravel avec ce quiz rapide !',
        ]);

        // 3. Ajouter 3 questions et leurs réponses

        // Question 1
        $q1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Que signifie ORM dans le contexte de l\'outil Eloquent utilisé par Laravel ?',
        ]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Object Relational Mapping', 'is_correct' => true]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Only Real Methods', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Over-Rated Model', 'is_correct' => false]);

        // Question 2
        $q2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Quel outil en ligne de commande est le compagnon standard de Laravel ?',
        ]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Artisan', 'is_correct' => true]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Breeze', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Valet', 'is_correct' => false]);

        // Question 3
        $q3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Quel moteur de template est utilisé par défaut dans Laravel ?',
        ]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Twig', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Smarty', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Blade', 'is_correct' => true]);
    }
}
