<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Domain\Entity;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class FacebookMessage
{
    private Uuid $id;

    private string $messageId;

    private string $groupId;

    private string $userId;

    private string $message;

    private DateTimeImmutable $sentAt;

    private string $status;

    public function __construct(
        string $messageId,
        string $groupId,
        string $userId,
        string $message,
        DateTimeImmutable $sentAt,
        string $status
    ) {
        $this->messageId = $messageId;
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->message = $message;
        $this->sentAt = $sentAt;
        $this->status = $status;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getSentAt(): DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
