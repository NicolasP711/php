<?php
$fruits = ['Pomme', 'Poire', 'Banane', 'Pasteque', 'Figue'];

// Fonction permettant d'afficher le contenu d'une variable avec un print_r entouré d'une balise html <pre>
function print_rv2($elementToDisplay){
    echo '<pre>';
    print_r($elementToDisplay);
    echo '</pre>';
}

// Fonction qui retourne un prix initial additionné avec une taxe précisé en second paramètre (20% par défaut)
function getTTCPrice($ht, $tax = 20){
    //Version simplifiée : return $ht * (($tax / 100) + 1);
    $taxToAdd = $ht * $tax / 100;
    $finalPrice = $ht + $taxToAdd;
    return $finalPrice;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo print_rv2('Bonjour');
    // Affichage de l'array des fruits avec la nouvelle fonction
    echo print_rv2($fruits);

    // Affichage du prix TTC de 19€
    echo getTTCprice(19);

    ?>
</body>
</html>