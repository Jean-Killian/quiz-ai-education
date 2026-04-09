<?php

namespace Tests\Unit;

use App\Services\QuizAIService;
use Tests\TestCase;

class QuizAIServiceTest extends TestCase
{
    /**
     * Teste le nettoyage d'un JSON entouré de Markdown.
     */
    public function test_it_cleans_json_from_markdown_blocks()
    {
        $service = new QuizAIService();
        
        $rawContent = "Voici le quiz : ```json\n{\"quiz\": []}\n``` Bonne chance.";
        $cleaned = $service->cleanJsonResponse($rawContent);
        
        $this->assertEquals('{"quiz": []}', $cleaned);
    }

    /**
     * Teste que le contenu est inchangé si déjà propre.
     */
    public function test_it_does_not_break_clean_json()
    {
        $service = new QuizAIService();
        
        $rawContent = '{"quiz": []}';
        $cleaned = $service->cleanJsonResponse($rawContent);
        
        $this->assertEquals('{"quiz": []}', $cleaned);
    }
}
