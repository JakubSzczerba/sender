<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender;

use Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium\SendMessageInterface;
use Sender\Sender\Core\Message\Infrastructure\Api\WeatherMessageGeneratorInterface;
use Sender\Sender\Core\Source\Weather\Infrastructure\Api\CityWeatherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SomeController extends AbstractController
{
    private CityWeatherInterface $cityWeather;

    private SendMessageInterface $sendMessage;

    private WeatherMessageGeneratorInterface $weatherMessageGenerator;

    public function __construct(
        CityWeatherInterface $cityWeather,
        SendMessageInterface $sendMessage,
        WeatherMessageGeneratorInterface $weatherMessageGenerator
    ) {
        $this->cityWeather = $cityWeather;
        $this->sendMessage = $sendMessage;
        $this->weatherMessageGenerator = $weatherMessageGenerator;
    }

    public function getWeatherByCity(string $city): JsonResponse
    {
        return $this->cityWeather->getWeatherByCity($city);
    }

    public function sendMessageToGroup(): JsonResponse
    {
        $groupId = $this->getParameter('facebook_group_id');
        $message = '2nd test after change file path and client refactor';

        return $this->sendMessage->sendMessageToGroup($groupId, $message);
    }

    public function generateText(): JsonResponse
    {
        $weatherData = $this->cityWeather->getWeatherByCity('Słupsk');

        return $this->weatherMessageGenerator->generateWeatherMessage($weatherData);
    }
}
