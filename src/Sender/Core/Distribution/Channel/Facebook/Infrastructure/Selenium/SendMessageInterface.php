<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium;

use Symfony\Component\HttpFoundation\JsonResponse;

interface SendMessageInterface
{
    public function sendMessageToGroup(string $groupId, string $message): JsonResponse;
}
