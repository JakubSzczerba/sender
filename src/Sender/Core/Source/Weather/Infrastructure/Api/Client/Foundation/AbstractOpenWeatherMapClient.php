<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Source\Weather\Infrastructure\Api\Client\Foundation;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractOpenWeatherMapClient
{
    protected string $apiKey;

    protected string $baseUrl;

    protected Client $client;

    public function __construct(
        string $apiKey,
        string $baseUrl,
        Client $client
    ) {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->client = $client;
    }

    protected function startConnection(): string
    {
        return "{$this->baseUrl}appid={$this->apiKey}&units=metric";
    }

    abstract public function getWeatherByCity(string $city): JsonResponse;
}
