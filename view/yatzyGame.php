<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

if ($_SESSION["section"] < 7) {
?>
<h1>Samla på <?= $_SESSION["section"] ?>:or</h1>
<p>Klicka i de tärningar du vill spara!</p>
<p>Du får kasta tärningarna 3 gånger.
Nu har du kastat <?= $_SESSION["rounds"] ?> gång/gånger.</p>
<h3>Din poäng: <?= $_SESSION["scoreYatzy"] ?></h3>


<p class="dice-utf8">
    <?php foreach ($_SESSION["listOfDices"] as $value) : ?>
        <i class="<?= $value ?>"></i>
    <?php endforeach; ?>
</p><?php
} ?>



<?php
if ($_SESSION["rounds"] < 3 && $_SESSION["section"] < 7) {
    ?>
    <form method="POST">
        <input type="checkbox" id="diceOne" name="diceOne" value="diceOne">
        <input type="checkbox" id="diceTwo" name="diceTwo" value="diceTwo">
        <input type="checkbox" id="diceThree" name="diceThree" value="diceThree">
        <input type="checkbox" id="diceFour" name="diceFour" value="diceFour">
        <input type="checkbox" id="diceFive" name="diceFive" value="diceFive">
        <br>
        <br>
        <br>
        <input type="submit" name="btn" value="Slå igen!">
    </form>
<?php } else if ($_SESSION["rounds"] == 3 && $_SESSION["section"] < 6) {
    ?><form method="POST">
        <input type="submit" name="btn" value="Slå igen!">
    </form>
<?php }
    if ($_SESSION["rounds"] == 3 && $_SESSION["section"] == 6) {
    ?><form method="POST">
        <input type="submit" name="btn" value="Resultat!">
    </form>
<?php }?>
