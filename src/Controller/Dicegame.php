<?php

declare(strict_types=1);

namespace sigridjonsson\Controller;

// use sigridjonsson\Dice\Game;

use sigridjonsson\Dice\Dice;
use sigridjonsson\Dice\GraphicalDice;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    redirectTo,
    renderView,
    url
};

/**
 * Controller for the dice game 21 routes.
 */
class Dicegame
{
    public function welcome(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION["total"] = 0;
        $_SESSION["win"] = $_SESSION["win"] ?? 0;
        $_SESSION["winComp"] = $_SESSION["winComp"] ?? 0;

        $body = renderView("layout/dice.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function postGame(): void
    {
        $psr17Factory = new Psr17Factory();

        if ($_POST["diceChoice"] == "one") {
            $_SESSION["diceNr"] = $_POST["diceChoice"];
            redirectTo(url("/diceGame"));
        } else if ($_POST["diceChoice"] == "two") {
            $_SESSION["diceNr"] = $_POST["diceChoice"];
            redirectTo(url("/diceGame"));
        } else if ($_POST["zero"] == "Nollställ") {
            $_SESSION["win"] = 0;
            $_SESSION["winComp"] = 0;
            redirectTo(url("/dice"));
        } else if ($_POST["diceChoice"] == null) {
            redirectTo(url("/dice"));
        }

        return;
    }

    public function playGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [];

        $diceGraph = new GraphicalDice();
        $res = [];
        $class = [];

        if ($_SESSION["diceNr"] == "one") {
            for ($i = 0; $i < 1; $i++) {
                $res[] = $diceGraph->roll();
                $class[] = $diceGraph->graphic();
            }
            $_SESSION["total"] += $diceGraph->getLastRoll();
        } else if ($_SESSION["diceNr"] == "two") {
            for ($i = 0; $i < 2; $i++) {
                $res[] = $diceGraph->roll();
                $class[] = $diceGraph->graphic();
            }
            $_SESSION["total"] += array_sum($res);
        }

        $data["class"] = $class;
        $body = renderView("layout/diceGame.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function postRes(): void
    {
        $psr17Factory = new Psr17Factory();

        if ($_POST["btn"] == "Stanna!") {
            redirectTo(url("/diceRes"));
        } else if ($_POST["btn"] == "Slå igen!") {
            redirectTo(url("/diceGame"));
        }

        return;
    }

    public function resGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [];

        $_SESSION["totalComp"] = 0;

        $diceComp = new Dice();
        while ($_SESSION["totalComp"] <= 21) {
            $diceComp->roll();
            $_SESSION["totalComp"] += $diceComp->getLastRoll();
        }
        $diff = 21 - $_SESSION["total"];
        $diffComp = $_SESSION["totalComp"] - 21;

        $data["diff"] = $diff;
        $data["diffComp"] = $diffComp;
        $body = renderView("layout/diceRes.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
