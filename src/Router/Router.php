<?php

declare(strict_types=1);

namespace sigridjonsson\Router;

use sigridjonsson\Dice\Game;

use function sigridjonsson\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        // } else if ($method === "GET" && $path === "/dice") {
        //     $callable = new Game();
        //     $callable->welcome();
        //     return;
        } else if ($method === "POST" && $path === "/dice") {
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
        } else if ($method === "GET" && $path === "/diceGame") {
            $callable2 = new Game();
            $callable2->playGame();
            return;
        } else if ($method === "POST" && $path === "/diceGame") {
            if ($_POST["btn"] == "Stanna!") {
                redirectTo(url("/diceRes"));
            } else if ($_POST["btn"] == "Slå igen!") {
                redirectTo(url("/diceGame"));
            }
            return;
        } else if ($method === "GET" && $path === "/diceRes") {
            $callable3 = new Game();
            $callable3->resGame();
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
