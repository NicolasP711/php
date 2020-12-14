<?php

// Exercice 10-a : Afficher la date avec la fonction date sous le format suivant : "friday 11 december 2020, 14h 55m 30s"

// echo date('l d F Y, H\h i\m s\s');

// Exercice 10-b : Chercher à afficher la date avec strftime en français en vous aidant de google et php.net
// Format attendu "Vendredi 11 décembre 2020, 14h 55m 30s"
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');
echo strftime('%A %d %B %Y, %Hh %Mm %Ss');
echo '<br>';

// Exercice 10-c : avec la fonction date() afficher la date qu'il sera dans 26 jours et 16 heures sous le format suivant :2020-12-11 07:11:21
echo date('Y-m-d H:i:s', time() + 26*24*3600 + 16*3600 );
echo '<br>';

//Exercice 10-d : créer une variable contenant cette date précise textuelle : "2004-04-16 12:00:00". Le but est d'ajouter 435 jours à cette date puis de l'afficher sous le format : "samedi 25 juin 2005 12h 00m 00s" (strftime sera utile pour la date en français)

//$dateToTransform = strtotime('2004-04-16 12:00:00');
//$dateToTransform = strftime('%A %d %B %Y, %Hh %Mm %Ss', time() - 6084*24*3600 + 435*24*3600);
//echo $dateToTransform;

// Correction 10-d

// En commentaire car déjà présent plus haut dans le fichier
// setlocale(LC_ALL, 'fr_FR.utf8', 'fra');

// date de départ sous forme textuelle
$dateToTransform = '2004-04-16 12:00:00';

// conversion de la date initiale en timestamp (pour pouvoir faire des calculs dessus)
$dateToTransformTimestamp = strtotime($dateToTransform);

// Création d'un nouveau timestamp qui correspond au timestamp initial + 435 jours
$newDateTimestamp = $dateToTransformTimestamp + 435 * 24 * 60 * 60;

// Affichage de la nouvelle date en utilisant son timestamp
echo strftime('%A %d %B %Y, %Hh %Mm %Ss' , $newDateTimestamp);
?>

