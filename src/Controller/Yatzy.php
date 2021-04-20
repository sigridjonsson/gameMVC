<?php

declare(strict_types=1);

namespace sigridjonsson\Controller;

use sigridjonsson\Dice\GraphicalDice;
use sigridjonsson\Dice\DiceHand;
use sigridjonsson\Dice\Dice;


use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function sigridjonsson\Functions\{
    redirectTo,
    renderView,
    url
};

/**
 * Controller for the Yatzy routes.
 */
class Yatzy
{
    public function welcome(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION["rounds"] = 0;

        $_SESSION["dice1"] = true;
        $_SESSION["dice2"] = true;
        $_SESSION["dice3"] = true;
        $_SESSION["dice4"] = true;
        $_SESSION["dice5"] = true;



        $body = renderView("layout/yatzy.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function playGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION["rounds"] += 1;


        $diceGraph = new GraphicalDice();


        if ($_SESSION["dice1"]) {
            $displayDice = $diceGraph->roll();
            $result[] = $displayDice;
            $_SESSION["dice1Val"] = $diceGraph->graphic();
        }
        if ($_SESSION["dice2"]) {
            $displayDice = $diceGraph->roll();
            $result[] = $displayDice;
            $_SESSION["dice2Val"] = $diceGraph->graphic();
        }
        if ($_SESSION["dice3"]) {
            $displayDice = $diceGraph->roll();
            $result[] = $displayDice;
            $_SESSION["dice3Val"] = $diceGraph->graphic();
        }
        if ($_SESSION["dice4"]) {
            $displayDice = $diceGraph->roll();
            $result[] = $displayDice;
            $_SESSION["dice4Val"] = $diceGraph->graphic();
        }
        if ($_SESSION["dice5"]) {
            $displayDice = $diceGraph->roll();
            $result[] = $displayDice;
            $_SESSION["dice5Val"] = $diceGraph->graphic();
        }


        $_SESSION["listOfDices"] = [];
        array_push($_SESSION["listOfDices"], $_SESSION["dice1Val"], $_SESSION["dice2Val"], $_SESSION["dice3Val"], $_SESSION["dice4Val"], $_SESSION["dice5Val"]);

        $_SESSION["dice1"] = true;
        $_SESSION["dice2"] = true;
        $_SESSION["dice3"] = true;
        $_SESSION["dice4"] = true;
        $_SESSION["dice5"] = true;


        $body = renderView("layout/yatzyGame.php");


        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function postRes(): void
    {
        $psr17Factory = new Psr17Factory();


        if ($_POST["btn"] == "Slå igen!" && isset($_POST["diceOne"])) {
            $_SESSION["dice1"] = false;
            redirectTo(url("/yatzyGame"));
        }
        if ($_POST["btn"] == "Slå igen!" && isset($_POST["diceTwo"])) {
            $_SESSION["dice2"] = false;
            redirectTo(url("/yatzyGame"));
        }
        if ($_POST["btn"] == "Slå igen!" && isset($_POST["diceThree"])) {
            $_SESSION["dice3"] = false;
            redirectTo(url("/yatzyGame"));
        }
        if ($_POST["btn"] == "Slå igen!" && isset($_POST["diceFour"])) {
            $_SESSION["dice4"] = false;
            redirectTo(url("/yatzyGame"));
        }
        if ($_POST["btn"] == "Slå igen!" && isset($_POST["diceFive"])) {
            $_SESSION["dice5"] = false;
            redirectTo(url("/yatzyGame"));
        }
        redirectTo(url("/yatzyGame"));

        return;
    }
}
