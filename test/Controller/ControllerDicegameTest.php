<?php

declare(strict_types=1);

namespace sigridjonsson\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class ControllerDicegameTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Dicegame();
        $this->assertInstanceOf("\sigridjonsson\Controller\Dicegame", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerWelcomeReturnsResponse()
    {
        $controller = new Dicegame();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->welcome();
        $this->assertInstanceOf($exp, $res);
    }

     /**
      * Check that the controller returns a response.
      */
    public function testControllerPlayGameReturnsResponse()
    {
        $controller = new Dicegame();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->playGame();
        $this->assertInstanceOf($exp, $res);
    }

      /**
       * Check that the controller returns a response.
       */
    public function testControllerResGameReturnsResponse()
    {
        $controller = new Dicegame();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->resGame();
        $this->assertInstanceOf($exp, $res);
    }

       /**
        * Check that playGame() returns one dice if $_SESSION["diceNr"] = "one".
        */
    public function testControllerPlayGameOneDice()
    {
        $controller = new Dicegame();

        $_SESSION["diceNr"] = "one";
        $controller->playGame();

        $exp = 1;
        $res = count($_SESSION["class"]);
        $this->assertSame($exp, $res);
    }

        /**
         * Check that playGame() returns two dices if $_SESSION["diceNr"] = "two".
         */
    public function testControllerPlayGameTwoDices()
    {
        $controller = new Dicegame();

        $_SESSION["diceNr"] = "two";
        $controller->playGame();

        $exp = 2;
        $res = count($_SESSION["class"]);
        $this->assertSame($exp, $res);
    }
}
