<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste l'accès à la liste des quiz.
     */
    public function test_user_can_see_quizzes_index()
    {
        $user = User::factory()->create();
        $quiz = Quiz::factory()->create(['title' => 'Quiz Test']);

        $response = $this->actingAs($user)->get(route('quizzes.index'));

        $response->assertStatus(200);
        $response->assertSee('Quiz Test');
    }

    /**
     * Teste que le score est correctement calculé même si certaines réponses sont manquantes.
     */
    public function test_user_can_submit_quiz_and_get_score()
    {
        $user = User::factory()->create();
        $quiz = Quiz::factory()->create();
        
        $q1 = Question::factory()->create(['quiz_id' => $quiz->id]);
        $correct1 = Answer::factory()->create(['question_id' => $q1->id, 'is_correct' => true]);
        $wrong1 = Answer::factory()->create(['question_id' => $q1->id, 'is_correct' => false]);

        $q2 = Question::factory()->create(['quiz_id' => $quiz->id]);
        $correct2 = Answer::factory()->create(['question_id' => $q2->id, 'is_correct' => true]);

        $response = $this->actingAs($user)->post(route('quizzes.submit', $quiz->id), [
            'answers' => [
                $q1->id => $correct1->id,
                $q2->id => 999, // Faux ID
            ]
        ]);

        $response->assertRedirect(route('quizzes.result', $quiz->id));
        
        $this->assertEquals(1, $user->quizzes()->where('quiz_id', $quiz->id)->first()->pivot->score);
    }

    /**
     * Teste qu'un utilisateur non authentifié est redirigé (Cas d'échec/Sécurité).
     */
    public function test_unauthenticated_user_cannot_access_quizzes()
    {
        $response = $this->get(route('quizzes.index'));
        $response->assertRedirect('/login');
    }
}
