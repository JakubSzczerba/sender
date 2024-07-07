<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
 */

declare(strict_types=1);

namespace Sender\Sender\Core\Distribution\Channel\Facebook\Application\Service;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Symfony\Component\HttpFoundation\JsonResponse;

class SendMessageService
{
    private string $host;

    private string $email;
    private string $password;

    public function __construct(
        string $host,
        string $email,
        string $password
    ) {
        $this->host = $host;
        $this->email = $email;
        $this->password = $password;
    }

    public function sendMessageToGroup(
        string $groupId,
        string $message
    ): JsonResponse {
        $driver = RemoteWebDriver::create($this->host, DesiredCapabilities::chrome());

        try {
            $driver->get('https://www.facebook.com/');
            $driver->findElement(WebDriverBy::id('email'))->sendKeys($this->email);
            $driver->findElement(WebDriverBy::id('pass'))->sendKeys($this->password);
            $driver->findElement(WebDriverBy::name('login'))->click();

            //$driver->wait()->until(WebDriverExpectedCondition::titleContains('Facebook'));
            $driver->get('https://www.facebook.com/messages/t/' . $groupId);

            $driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div[aria-label="Wiadomość"][contenteditable="true"]')));

            $messageBox = $driver->findElement(WebDriverBy::cssSelector('div[aria-label="Wiadomość"][contenteditable="true"]'));
            $messageBox->sendKeys($message . WebDriverKeys::ENTER);

            $driver->quit();

            return new JsonResponse(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            $driver->quit();
            return new JsonResponse(['status' => 'Error', 'message' => $e->getMessage()]);
        }

        /*
         try {
            // Otwórz Facebooka i zaloguj się
            echo "Opening Facebook login page\n";
            $driver->get('https://www.facebook.com/');
            $driver->findElement(WebDriverBy::id('email'))->sendKeys($this->email);
            $driver->findElement(WebDriverBy::id('pass'))->sendKeys($this->password)->sendKeys(WebDriverKeys::ENTER);

            // Poczekaj na zalogowanie się
            echo "Waiting for Facebook login\n";
            $driver->wait()->until(WebDriverExpectedCondition::titleContains('Facebook'));

            // Sprawdź, czy jesteśmy zalogowani
            echo "Checking login status\n";
            $profileIcon = $driver->findElements(WebDriverBy::cssSelector('div[data-click="profile_icon"]'));
            if (count($profileIcon) === 0) {
                echo "Login elements not found\n";
                echo $driver->getPageSource(); // Wyświetl stronę, jeśli logowanie się nie powiedzie
                throw new \Exception('Login failed');
            }

            // Przejdź do Messengera
            echo "Navigating to Messenger group\n";
            $driver->get('https://www.facebook.com/messages/t/' . $groupId);

            // Poczekaj, aż strona się załaduje
            echo "Waiting for Messenger to load\n";
            $driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div[aria-label="Wiadomość"][contenteditable="true"]')));

            // Znajdź pole do wpisania wiadomości i wyślij wiadomość
            echo "Sending message\n";
            $messageBox = $driver->findElement(WebDriverBy::cssSelector('div[aria-label="Wiadomość"][contenteditable="true"]'));
            $messageBox->sendKeys($message . WebDriverKeys::ENTER);

            echo "Message sent successfully!";
            $driver->quit();

            return new JsonResponse(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            $driver->quit();
            return new JsonResponse(['status' => 'Error', 'message' => $e->getMessage()]);
        }
        */
    }
}
