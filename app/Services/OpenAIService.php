<?php

namespace App\Services;

use App\Exceptions\OpenAIException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class OpenAIService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request(string $prompt, float $temp): string
    {
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
                    'max_tokens' => 500
                ]
            ]);
            $body = json_decode($response->getBody(), true);

            return $body['choices'][0]['message']['content'];
        } catch (ClientException $e) {
            throw new OpenAIException($e->getResponse()->getBody()->getContents());
        }
    }
}
