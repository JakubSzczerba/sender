<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Message\Infrastructure\Api\Client\Foundation;

use GuzzleHttp\Client;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractHuggingFaceInferenceClient
{
    protected string $key;

    protected string $url;

    protected Client $client;

    protected const MODEL = 'gpt2';

    public function __construct(
        string $key,
        string $url,
        Client $client
    ) {
        $this->key = $key;
        $this->url = $url;
        $this->client = $client;
    }

    protected function startConnection(): string
    {
        return $this->url . self::MODEL;
    }

    protected function setHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->key,
            'Content-Type' => 'application/json'
        ];
    }

    protected function executeRequest(string $prompt): JsonResponse
    {
        try {
            $response = $this->client->post($this->startConnection(), [
                'headers' => $this->setHeaders(),
                'json' => [
                    'inputs' => $prompt
                ]
            ]);

            return new JsonResponse(
                json_decode(
                    $response->getBody()->getContents(),
                    true
                )
            );
        } catch (Exception $e) {
            throw new \RuntimeException('Request to Hugging Face API failed: ' . $e->getMessage());
        }
    }

    abstract public function generateWeatherMessage(JsonResponse $weatherData): JsonResponse;
}
