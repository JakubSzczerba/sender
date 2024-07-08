<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium\Client;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium\Client\Foundation\AbstractFacebookClient;
use Sender\Sender\Core\Distribution\Channel\Facebook\Infrastructure\Selenium\SendMessageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FacebookClient extends AbstractFacebookClient implements SendMessageInterface
{
    public function sendMessageToGroup(
        string $groupId,
        string $message
    ): JsonResponse {
        $driver = RemoteWebDriver::create($this->host, DesiredCapabilities::chrome());

        try {
            $driver->get('https://www.facebook.com/');
            $driver->findElement(WebDriverBy::id('email'))->sendKeys($this->email);
            $driver->findElement(WebDriverBy::id('pass'))->sendKeys($this->password);

            $loginButton = $driver->findElement(WebDriverBy::name('login'));
            $driver->executeScript('arguments[0].click();', [$loginButton]); sleep(random_int(2, 13));

            $driver->get('https://www.facebook.com/messages/t/' . $groupId); sleep(random_int(1, 12));

            $messageBox = $driver->findElement(WebDriverBy::cssSelector('div[aria-label="Wiadomość"][contenteditable="true"]'));
            $messageBox->sendKeys($message); sleep(random_int(3, 9));

            $driver->takeScreenshot($this->fileName());

            $driver->executeScript(
                'arguments[0].dispatchEvent(new KeyboardEvent("keydown", {key: "Enter"}));',
                [$messageBox]); sleep(random_int(3, 11));

            $driver->quit();

            return new JsonResponse(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            sleep(4);
            $driver->takeScreenshot($this->fileName());
            $driver->quit();
            return new JsonResponse(['status' => 'Error', 'message' => $e->getMessage()]);
        }
    }
}
