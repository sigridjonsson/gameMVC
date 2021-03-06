<?php

declare(strict_types=1);

namespace sigridjonsson\Controller;

use sigridjonsson\Dice\GraphicalDice;
use sigridjonsson\Dice\DiceHand;
use sigridjonsson\Dice\Dice;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
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
        $_SESSION["section"] = 1;
        $_SESSION["scoreYatzy"] = 0;

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

        $result = [];


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

        if ($_SESSION["rounds"] == 4) {
            $_SESSION["rounds"] = 1;
            $_SESSION["section"] += 1;
        } else if ($_SESSION["rounds"] == 3) {
            $_SESSION["dices"] = [];
            foreach ($_SESSION["listOfDices"] as $value) {
                $_SESSION["dices"][] = intval(substr($value, -1, 1));
            }

            foreach ($_SESSION["dices"] as $value) {
                if ($value == $_SESSION["section"]) {
                    $_SESSION["scoreYatzy"] += $value;
                }
            }
        }




        $body = renderView("layout/yatzyGame.php");


        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function postRes(): void
    {
        if (isset($_POST["diceOne"])) {
            $_SESSION["dice1"] = false;
        }
        if (isset($_POST["diceTwo"])) {
            $_SESSION["dice2"] = false;
        }
        if (isset($_POST["diceThree"])) {
            $_SESSION["dice3"] = false;
        }
        if (isset($_POST["diceFour"])) {
            $_SESSION["dice4"] = false;
        }
        if (isset($_POST["diceFive"])) {
            $_SESSION["dice5"] = false;
        }

        if ($_POST["btn"] == "Sl?? igen!") {
            redirectTo(url("/yatzyGame"));
        } else if ($_POST["btn"] == "Resultat!") {
            redirectTo(url("/yatzyRes"));
        }

        return;
    }

    public function resGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [];

        if ($_SESSION["scoreYatzy"] >= 63) {
            $_SESSION["scoreYatzy"] += 50;
            $data["message"] = "Grattis! Du samlade ihop 63 po??ng eller mer
            och har d??rf??r gjort dig f??rtj??nt av bonusen p?? 50 po??ng.";
        } else if ($_SESSION["scoreYatzy"] < 63) {
            $data["message"] = "Grattis!";
        }


        $body = renderView("layout/yatzyRes.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
