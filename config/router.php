<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});


// 21
$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\sigridjonsson\Controller\Dicegame", "welcome"]);
    $router->addRoute("POST", "", ["\sigridjonsson\Controller\Dicegame", "postGame"]);
});

$router->addGroup("/diceGame", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\sigridjonsson\Controller\Dicegame", "playGame"]);
    $router->addRoute("POST", "", ["\sigridjonsson\Controller\Dicegame", "postRes"]);
});

$router->addRoute("GET", "/diceRes", ["\sigridjonsson\Controller\Dicegame", "resGame"]);



// YATZY
$router->addRoute("GET", "/yatzy", ["\sigridjonsson\Controller\Yatzy", "welcome"]);

$router->addRoute("GET", "/yatzyGame", ["\sigridjonsson\Controller\Yatzy", "playGame"]);
$router->addRoute("POST", "/yatzyGame", ["\sigridjonsson\Controller\Yatzy", "postRes"]);

$router->addRoute("GET", "/yatzyRes", ["\sigridjonsson\Controller\Yatzy", "resGame"]);
