<?php

declare(strict_types=1);

namespace sigridjonsson\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Yatzy();
        $this->assertInstanceOf("\sigridjonsson\Controller\Yatzy", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
     public function testControllerWelcomeReturnsResponse()
     {
         $controller = new Yatzy();

         $exp = "\Psr\Http\Message\ResponseInterface";
         $res = $controller->welcome();
         $this->assertInstanceOf($exp, $res);
     }

     /**
      * Check that the controller returns a response.
      */
      public function testControllerPlayGameReturnsResponse()
      {
          $controller = new Yatzy();

          $exp = "\Psr\Http\Message\ResponseInterface";
          $res = $controller->playGame();
          $this->assertInstanceOf($exp, $res);
      }

      /**
       * Check that the controller returns a response.
       */
       public function testControllerResGameReturnsResponse()
       {
           $controller = new Yatzy();

           $exp = "\Psr\Http\Message\ResponseInterface";
           $res = $controller->resGame();
           $this->assertInstanceOf($exp, $res);
       }

       /**
        * Check that $_SESSION["rounds"] is reset to 1 every third round.
        */
        public function testControllerRounds()
        {
            $controller = new Yatzy();

            $_SESSION["rounds"] = 3;
            $controller->playGame();

            $exp = 1;
            $res = $_SESSION["rounds"];
            $this->assertSame($exp, $res);
        }

        /**
         * Check that $_SESSION["dices"] contains integers and not strings.
         */
         public function testControllerListOfDices()
         {
             $controller = new Yatzy();

             $_SESSION["rounds"] = 2;
             $controller->playGame();

             $exp = "integer";
             $res = $_SESSION["dices"];
             $this->assertContainsOnly($exp, $res);
         }

         /**
          * Check that $_SESSION["score"] is either the same or greater after three rounds.
          */
          public function testControllerScore()
          {
              $controller = new Yatzy();

              $_SESSION["rounds"] = 2;
              $_SESSION["section"] = 1;
              $_SESSION["scoreYatzy"] = 0;
              $controller->playGame();

              $val1 = 0;
              $val2 = $_SESSION["scoreYatzy"];
              $this->assertGreaterThanOrEqual($val1, $val2);
          }

        /**
         * Check that the bonus 50 points are given if you score 63 or more.
         */
         public function testControllerBonus()
         {
             $controller = new Yatzy();

             $_SESSION["scoreYatzy"] = 63;
             $controller->resGame();

             $exp = 63 + 50;
             $res = $_SESSION["scoreYatzy"];
             $this->assertSame($exp, $res);
         }

}
