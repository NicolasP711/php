<?php

// Récupération du nombre actuel de visite
$visits = file_get_contents('compteur.txt');

// Augmentation du nombre de visistes de 1
$visits++;

// Sauvegarde du nouveau nombre dans le fichier compteur.txt
file_put_contents('compteur.txt', $visits);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Il y a eu <?php echo $number; ?> visite sur cette page !</h1>
</body>
</html>