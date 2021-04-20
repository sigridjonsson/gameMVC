<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

?>
<h1>Runda x</h1>
<p>Klicka i de tärningar du vill spara!</p>

<p class="dice-utf8">
    <?php foreach ($_SESSION["listOfDices"] as $value) : ?>
        <i class="<?= $value ?>"></i>
    <?php endforeach; ?>
</p>

<form method="POST">
    <input type="checkbox" id="diceOne" name="diceOne" value="diceOne">
    <input type="checkbox" id="diceTwo" name="diceTwo" value="diceTwo">
    <input type="checkbox" id="diceThree" name="diceThree" value="diceThree">
    <input type="checkbox" id="diceFour" name="diceFour" value="diceFour">
    <input type="checkbox" id="diceFive" name="diceFive" value="diceFive">
    <br>
    <br>
    <br>
    <?php if ($_SESSION["rounds"] == 3) {
        ?><input type="submit" name="btn" value="Resultat!"><?php
    } else if ($_SESSION["rounds"] < 3) {
        ?><input type="submit" name="btn" value="Slå igen!"><?php
    } ?>
</form>

<p><?= var_dump($_SESSION["rounds"]) ?></p>
