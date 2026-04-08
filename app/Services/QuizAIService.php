<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class QuizAIService
{
    protected Client $client;
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct()
    {
        $this->client = new Client();
        // Support de l'ancien nom de variable au cas où
        $this->apiKey = env('GEMINI_API_KEY', env('MISTRAL_API_KEY', ''));
        
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException("La clé GEMINI_API_KEY est introuvable ou vide dans le fichier .env !");
        }
    }

    /**
     * Envoie la requête à l'API Gemini.
     */
    public function generateQuestionnaire(string $prompt): array
    {
        $body = $this->buildRequestBody($prompt);
        $url = $this->baseUrl . '?key=' . $this->apiKey;

        try {
            Log::info('Sending request to Gemini API');

            $response = $this->client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            $content = $response->getBody()->getContents();
            Log::info('Gemini API response received successfully');

            return json_decode($content, true);

        } catch (RequestException $e) {
            $message = $e->hasResponse()
                ? $e->getResponse()->getBody()->getContents()
                : $e->getMessage();

            Log::error('Gemini API error', ['error' => $message]);
            throw new \Exception("Gemini API request failed: " . $message);
        }
    }

    /**
     * Prépare le payload spécifique à Gemini.
     */
    protected function buildRequestBody(string $prompt): array
    {
        return [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.4,
                'responseMimeType' => 'application/json',
            ]
        ];
    }
}
