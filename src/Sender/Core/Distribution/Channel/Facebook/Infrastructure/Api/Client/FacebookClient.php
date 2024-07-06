<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Api\Client;

use Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Api\Client\Foundation\AbstractFacebookClient;
use Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Api\SendMessageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FacebookClient extends AbstractFacebookClient implements SendMessageInterface
{
    public function sendMessageToGroup(string $groupId, string $message): JsonResponse
    {
        $request = $this->startConnection();

        $response = $this->client->post($request, [
            'json' => [
                'recipient' => ['id' => $groupId],
                'message' => ['text' => $message],
            ]
        ]);

        return new JsonResponse(
            json_decode(
                $response->getBody()->getContents(),
                true
            )
        );
    }
}
