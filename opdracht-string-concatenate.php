<?php
  $voornaam = "Lore";
  $achternaam = "Vanderlinden";

  $volledigeNaam = $voornaam . " " . $achternaam;
  $naamLengte = strlen($volledigeNaam);
?>

<!doctype html>
<html>
  <head>Opdracht: string concatenate</head>

  <body>
    <h1>Opdracht: string concatenate</h1>

    <p><?php echo $volledigeNaam ?>

    <p>Aantal karakters in <?php echo $volledigeNaam?>: <?php echo $naamLengte ?> </p>

  </body>
</html>
