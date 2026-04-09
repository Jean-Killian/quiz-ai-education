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
        $this->client = new Client(['timeout' => 10]); // Fast timeout since Groq is <1s usually
        $this->apiKey = env('GROQ_API_KEY', env('GEMINI_API_KEY', ''));
        
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException("La clé GROQ_API_KEY est introuvable ou vide dans le fichier .env !");
        }
    }

    /**
     * Envoie la requête à l'API Groq (Standard OpenAI).
     * 
     * @param string $prompt Le prompt de génération du quiz.
     * @return array La réponse décodée de l'IA.
     * @throws \Exception Si la requête échoue.
     */
    public function generateQuestionnaire(string $prompt): array
    {
        $body = $this->buildRequestBody($prompt);

        try {
            Log::info('Sending request to Groq Llama 3 API for extreme speed.');

            $response = $this->client->post($this->baseUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            $content = $response->getBody()->getContents();
            Log::info('Groq API response received successfully.');

            return json_decode($content, true);

        } catch (RequestException $e) {
            $message = $e->hasResponse()
                ? $e->getResponse()->getBody()->getContents()
                : $e->getMessage();

            Log::error('Groq Llama 3 API error', ['error' => $message]);
            throw new \Exception("Groq API request failed: " . $message);
        }
    }

    /**
     * Prépare le payload spécifique au format OpenAI pour Groq.
     * 
     * @param string $prompt Instructions pour l'IA.
     * @return array Structure JSON pour l'API.
     */
    protected function buildRequestBody(string $prompt): array
    {
        return [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un expert en code review. Tu dois obligatoirement renvoyer un JSON valide structuré exactement selon la demande, sans aucun autre texte.'
                ],
                [
                    'role' => 'user', 
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.3,
            'response_format' => [
                'type' => 'json_object'
            ]
        ];
    }

    /**
     * Nettoie une chaîne JSON pouvant être entourée de texte ou de blocs Markdown.
     * 
     * @param string $content Le contenu brut renvoyé par l'IA.
     * @return string Le JSON pur extrait.
     */
    public function cleanJsonResponse(string $content): string
    {
        $start = strpos($content, '{');
        $end = strrpos($content, '}');

        if ($start !== false && $end !== false) {
            return substr($content, $start, $end - $start + 1);
        }

        return $content;
    }
}
