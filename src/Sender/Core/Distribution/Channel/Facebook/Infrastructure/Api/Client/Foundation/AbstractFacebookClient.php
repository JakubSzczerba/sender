<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Api\Client\Foundation;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractFacebookClient
{
    protected string $pageAccessToken;

    protected string $baseUrl;

    protected Client $client;

    public function __construct(
        string $pageAccessToken,
        string $baseUrl,
        Client $client
    ) {
        $this->pageAccessToken = $pageAccessToken;
        $this->baseUrl = $baseUrl;
        $this->client = $client;
    }

    protected function startConnection(): string
    {
        return "{$this->baseUrl}access_token=" . $this->pageAccessToken;
    }

    abstract public function sendMessageToGroup(string $groupId, string $message): JsonResponse;
}
