<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class QuizAIService
{
    protected Client $client;
    protected string $apiKey;
    protected string $baseUrl = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GROQ_API_KEY', '');
        
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException("La clé GROQ_API_KEY est introuvable ou vide dans le fichier .env !");
        }
    }

    /**
     * Envoie la requête à l'API Groq.
     */
    public function generateQuestionnaire(string $prompt): array
    {
        $body = $this->buildRequestBody($prompt);

        try {
            Log::info('Sending request to Groq API');

            $response = $this->client->post($this->baseUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => $body,
            ]);

            $content = $response->getBody()->getContents();
            Log::info('Groq API response received successfully');

            return json_decode($content, true);

        } catch (RequestException $e) {
            $message = $e->hasResponse()
                ? $e->getResponse()->getBody()->getContents()
                : $e->getMessage();

            Log::error('Groq API error', ['error' => $message]);
            throw new \Exception("Groq API request failed: " . $message);
        }
    }

    /**
     * Prépare le payload spécifique à Groq (format OpenAI).
     */
    protected function buildRequestBody(string $prompt): array
    {
        return [
            'model' => env('GROQ_MODEL', 'llama3-8b-8192'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.4,
            'response_format' => ['type' => 'json_object']
        ];
    }
}
