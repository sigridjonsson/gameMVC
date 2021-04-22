<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;


if ($_SESSION["total"] < 21) {
    ?>
    <p class="dice-utf8">
    <?php foreach ($_SESSION["class"] as $value) : ?>
        <i class="<?= $value ?>"></i>
    <?php endforeach; ?>
    </p>
    <p>Summa: <?= $_SESSION["total"] ?></p>
    <form method="POST">
        <input type="submit" name="btn" value="Slå igen!">
    </form>
    <br>
    <form method="POST">
        <input type="submit" name="btn" value="Stanna!">
    </form>
    <?php
} else if ($_SESSION["total"] > 21) {
    $_SESSION["winComp"] += 1;
    ?> <h1>Otur! Denna rundan vann datorn!</h1>
    <p>Du fick: <?= $_SESSION["total"] ?></p>
    <?php
} else if ($_SESSION["total"] == 21) {
    $_SESSION["win"] += 1;
    ?> <h1>Grattis, du vann! +1 poäng!</h1>
    <p>Du fick: <?= $_SESSION["total"] ?></p>
    <?php
}
