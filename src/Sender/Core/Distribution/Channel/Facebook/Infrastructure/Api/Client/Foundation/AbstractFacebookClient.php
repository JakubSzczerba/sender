<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Api\Client\Foundation;

use Sender\Sender\Core\Base\Api\Client\AbstractApiClient;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractFacebookClient extends AbstractApiClient
{
    protected function startConnection(array $params = []): string
    {
        $params['access_token'] = $this->key;

        return $this->url . http_build_query($params);
    }

    abstract public function sendMessageToGroup(string $groupId, string $message): JsonResponse;
}
