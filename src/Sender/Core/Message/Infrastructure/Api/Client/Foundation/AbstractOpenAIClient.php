<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

namespace Sender\Sender\Core\Message\Infrastructure\Api\Client\Foundation;

use OpenAI;
use OpenAI\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractOpenAIClient
{
    protected Client $client;

    protected LoggerInterface $logger;

    public function __construct(
        string $key,
        LoggerInterface $logger
    ) {
        $this->client = OpenAI::client($key);
        $this->logger = $logger;
    }

    protected function callOpenAI(
        string $prompt,
        array $additionalParams = []
    ): string {
        try {
            $result = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            return $result->choices[0]->message->content;
        } catch (\Exception $e) {
            $this->logger->error('OpenAI API request failed', ['exception' => $e]);
            throw new \RuntimeException('Failed to generate message using OpenAI');
        }
    }

    abstract public function generateWeatherMessage(JsonResponse $weatherData): string;
}
