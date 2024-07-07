<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Source\Weather\Infrastructure\Api\Client;

use Sender\Sender\Core\Source\Weather\Infrastructure\Api\CityWeatherInterface;
use Sender\Sender\Core\Source\Weather\Infrastructure\Api\Client\Foundation\AbstractOpenWeatherMapClient;
use Symfony\Component\HttpFoundation\JsonResponse;

final class OpenWeatherMapClient extends AbstractOpenWeatherMapClient implements CityWeatherInterface
{
    public function getWeatherByCity(string $city): JsonResponse
    {
        $url = $this->startConnection() . "&q={$city}";
        $response = $this->client->get($url);

        return new JsonResponse(
            json_decode(
                $response->getBody()->getContents(),
                true
            )
        );
    }
}
