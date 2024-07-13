<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium\Client\Foundation;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractFacebookClient
{
    protected string $host;

    protected string $email;

    protected string $password;

    public function __construct(
        string $host,
        string $email,
        string $password
    ) {
        $this->host = $host;
        $this->email = $email;
        $this->password = $password;
    }

    abstract protected function sendMessageToGroup(
        string $groupId,
        string $message
    ): JsonResponse;

    protected function fileName(): string
    {
        return $this->getScreenshotPath() . '/' . $this->getCurrentTime() . '.png';
    }

    private function getScreenshotPath(): string
    {
        $path = __DIR__ . '/screenshots/facebook/' . date('d-m-Y');
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    private function getCurrentTime(): string
    {
        $dateTime = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw'));
        return $dateTime->format('d-m-Y_H-i-s.v');
    }
}
