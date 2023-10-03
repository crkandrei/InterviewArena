<?php

namespace App\Services;

use App\Exceptions\OpenAIException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;


class OpenAIService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request(string $prompt, float $temp): string
    {
        $this->log('info', 'Sending request to OpenAI', ['prompt' => $prompt, 'temperature' => $temp]);

        try {
            $response = $this->client->post(config('openai.url'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('openai.api_key')
                ],
                'json' => [
                    'model' => config('openai.model'),
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'temperature' => $temp,
                    'max_tokens' => 1000
                ]
            ]);
            $body = json_decode($response->getBody(), true);

            $content = $body['choices'][0]['message']['content'];

            $this->log('info', 'Received response from OpenAI', ['response_content' => $content]);

            return $content;
        } catch (ClientException $e) {
            $errorMessage = $e->getResponse()->getBody()->getContents();
            $this->log('error', 'OpenAI request failed', ['error_message' => $errorMessage]);
            throw new OpenAIException($e->getResponse()->getBody()->getContents());
        }
    }

    private function log(string $level, string $message, array $context = [])
    {
        Log::channel('openai')->$level($message, $context);
    }
}
