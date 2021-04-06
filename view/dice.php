<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
?>

<h2>Välj hur många tärningar du vill köra med:</h2>
<form method="POST">
    <input type="radio" id="one" name="diceChoice" value="one">
    <label for="one">1</label><br>
    <input type="radio" id="two" name="diceChoice" value="two">
    <label for="two">2</label><br>
    <br>
    <input type="submit" value="Starta spelet!"></input>
</form>
<br>
<br>
<br>

<h2>Du vs. Datorn</h2>
<p><?= $_SESSION["win"] ?> - <?= $_SESSION["winComp"] ?></p>
<br>
<form method="POST">
    <input type="submit" name="zero" value="Nollställ"></input>
</form>
