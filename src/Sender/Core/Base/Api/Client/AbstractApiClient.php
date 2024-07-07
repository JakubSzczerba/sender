<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Base\Api\Client;

use GuzzleHttp\Client;

abstract class AbstractApiClient
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

    abstract protected function startConnection(array $params = []): string;
}
