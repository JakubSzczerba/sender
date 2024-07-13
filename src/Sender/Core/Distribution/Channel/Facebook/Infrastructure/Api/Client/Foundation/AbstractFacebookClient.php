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
    protected string $key;

    protected string $url;

    protected Client $client;

    public function __construct(
        string $key,
        string $url,
        Client $client
    ) {
        $this->key = $key;
        $this->url = $url;
        $this->client = $client;
    }

    protected function startConnection(array $params = []): string
    {
        $params['access_token'] = $this->key;

        return $this->url . http_build_query($params);
    }

    abstract public function sendMessageToGroup(string $groupId, string $message): JsonResponse;
}
