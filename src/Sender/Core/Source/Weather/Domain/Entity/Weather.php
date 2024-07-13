<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Source\Weather\Domain\Entity;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class Weather
{
    private Uuid $id;

    private float $temperature;

    private float $cloudiness;

    private string $wind;

    private string $description;

    private string $longitude;

    private string $latitude;

    private string $city;

    private DateTimeImmutable $createdAt;

    public function __construct(
        float $temperature,
        float $cloudiness,
        string $wind,
        string $description,
        string $longitude,
        string $latitude,
        string $city,
        DateTimeImmutable $createdAt
    ) {
        $this->temperature = $temperature;
        $this->cloudiness = $cloudiness;
        $this->wind = $wind;
        $this->description = $description;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->city = $city;
        $this->createdAt = $createdAt;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getCloudiness(): float
    {
        return $this->cloudiness;
    }

    public function getWind(): string
    {
        return $this->wind;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
