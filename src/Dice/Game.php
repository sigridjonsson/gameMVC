<?php

declare(strict_types=1);

namespace sigridjonsson\Dice;

use sigridjonsson\Dice\Dice;

use sigridjonsson\Dice\DiceHand;

use sigridjonsson\Dice\GraphicalDice;

use function sigridjonsson\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game.
 */
class Game
{
    public function welcome(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Hey!",
        ];

        $_SESSION["total"] = 0;
        $_SESSION["win"] = $_SESSION["win"] ?? 0;
        $_SESSION["winComp"] = $_SESSION["winComp"] ?? 0;

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function playGame(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Hey!",
        ];

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
        sendResponse($body);
    }

    public function resGame(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Hey!",
        ];

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
        sendResponse($body);
    }
}
