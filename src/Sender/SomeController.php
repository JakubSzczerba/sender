<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender;

use Sender\Sender\Core\Source\Weather\Infrastructure\Api\CityWeatherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SomeController extends AbstractController
{
    private CityWeatherInterface $cityWeather;

    public function __construct(CityWeatherInterface $cityWeather)
    {
        $this->cityWeather = $cityWeather;
    }

    public function getWeatherByCity(string $city): JsonResponse
    {
        return $this->cityWeather->getWeatherByCity($city);
    }
}
