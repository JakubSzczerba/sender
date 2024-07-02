<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Source\Weather\Infrastructure\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

interface CityWeatherInterface
{
    public function getWeatherByCity(string $city): JsonResponse;
}
