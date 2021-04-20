<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
?>
<h1>Resultat</h1>

<h3><?= $data["message"] ?></h3>
<h4>Din poäng: <?= $_SESSION["scoreYatzy"] ?></h4>
