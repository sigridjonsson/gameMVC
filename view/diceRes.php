<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
?>

<h1>Resultat!</h1>
<p>Ditt resultat: <?= $_SESSION["total"] ?></p>
<p>Datorns resultat: <?= $_SESSION["totalComp"] ?></p>


<?php
if ($_SESSION["total"] == 21) {
    $_SESSION["win"] += 1;
    ?> <p>Du vann!</p>
    <?php
} else if ($_SESSION["totalComp"] == 21) {
    $_SESSION["winComp"] += 1;
    ?> <p>Datorn vann!</p>
    <?php
} else if ($data["diff"] > $data["diffComp"]) {
    $_SESSION["winComp"] += 1;
    ?><p>Datorn vann!</p><?php
} else if ($data["diff"] < $data["diffComp"]) {
    $_SESSION["win"] += 1;
    ?><p>Du vann!</p><?php
} else if ($data["diff"] == $data["diffComp"]) {
    $_SESSION["winComp"] += 1;
    ?><p>Oavgjort!</p><?php
}
