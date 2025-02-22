<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Message\Infrastructure\Api\Client;

use Sender\Sender\Core\Message\Infrastructure\Api\Client\Foundation\AbstractHuggingFaceInferenceClient;
use Sender\Sender\Core\Message\Infrastructure\Api\WeatherMessageGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HuggingFaceInferenceClient extends AbstractHuggingFaceInferenceClient implements WeatherMessageGeneratorInterface
{
    public function generateWeatherMessage(JsonResponse $weatherData): JsonResponse
    {
        $prompt = "
        Wygeneruj wiadomość pogodową po polsku, na podstawie poniższych danych. Ma być ładnie opisana oraz mają być
        użyte emotikony, ponieważ będzie wysłana na messengerze. Opisane jakby mówił to prezenter pogodowy. Dane:
        {$weatherData}. 
        ";

        return $this->executeRequest($prompt);
    }
}
