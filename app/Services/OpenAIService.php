<?php

namespace App\Services;

use OpenAI;
use OpenAI\Contracts\TransporterContract;
use OpenAI\Transports\HttpTransporter;
use GuzzleHttp\Client as GuzzleClient; 

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $apiKey = env('OPENAI_API_KEY');

        // Configuração do cliente HTTP personalizado (desativando SSL)
        $httpClient = new GuzzleClient([
            'verify' => false, // Desativa a verificação de SSL (apenas para testes locais)
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        // Criação do cliente OpenAI
        $this->client = OpenAI::factory()->withHttpClient($httpClient)->make();
    }

    public function generateText(string $prompt, int $maxTokens = 150): string
    {
        $response = $this->client->completions()->create([
            'model' => 'gpt-4o',
            'prompt' => $prompt,
            'max_tokens' => $maxTokens,
        ]);

        return $response['choices'][0]['text'];
    }
}
