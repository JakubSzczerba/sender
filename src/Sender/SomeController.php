<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender;

use Sender\Sender\Core\Distribution\Channel\Facebook\Application\Service\SendMessageService;
use Sender\Sender\Core\Source\Weather\Infrastructure\Api\CityWeatherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class SomeController extends AbstractController
{
    private CityWeatherInterface $cityWeather;

    private SendMessageService $sendMessageService;

    public function __construct(
        CityWeatherInterface $cityWeather,
        SendMessageService $sendMessageService
    ) {
        $this->cityWeather = $cityWeather;
        $this->sendMessageService = $sendMessageService;
    }

    public function getWeatherByCity(string $city): JsonResponse
    {
        return $this->cityWeather->getWeatherByCity($city);
    }

    public function sendMessageToGroup(): JsonResponse
    {
        $groupId = $this->getParameter('facebook_group_id');
        $this->sendMessageService->sendMessageToGroup($groupId, 'Test wiadomości');

        return new JsonResponse(['status' => 'Message sent successfully']);
    }
}
