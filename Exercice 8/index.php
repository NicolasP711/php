<?php

// Création d'un array contenant des utilisateurs avec leurs infos (les pays sont eux même un sous sous-tableau)
$usersList = [
    [
        'firstname' => 'Bob',
        'lastname' => 'Dupont',
        'age' => 10,
        'countries' => ['France', 'Italie'],
    ],
    [
        'firstname' => 'John',
        'lastname' => 'Ranger',
        'age' => 11,
        'countries' => ['Japon'],
    ],
    [
        'firstname' => 'Akira',
        'lastname' => 'Toriyama',
        'age' => 12,
        'countries' => [],  // Pas de pays visité donc array vide
    ],
    [
        'firstname' => 'Jean',
        'lastname' => 'Neymar',
        'age' => 13,
        'countries' => ['France', 'Espagne'],
    ],
    [
        'firstname' => 'Logan',
        'lastname' => 'Paul',
        'age' => 14,
        'countries' => ['France', 'Italie', 'Espagne'],
    ],
];
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
        foreach($usersList as $users){

            echo '<h2>' . $userI


        }

    ?>
</body>
</html>