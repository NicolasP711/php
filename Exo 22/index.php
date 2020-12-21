<?php
    // Connexion au fichier
    $myFile = fopen('compteur.txt', "r+");

    // Récupération du nombre actuel de visite
    $number = fread($myFile, 12);
    // Augmentation du nombre de visites de 1
    $number ++;
    // Replacement du curseur au début du fichier
    fseek($myFile, 0);
    // Ecriture du nouveau contenu dans le fichier à la place de l'ancien
    fwrite($myFile, $number);
    // Fermeture de la connexion
    fclose($myFile);
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