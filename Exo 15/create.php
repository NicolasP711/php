<?php

    // Obligatoire pour avoir accès aux sessions
    session_start();

    // Si l'array "user" n'existe pas en session, on le crée avec ses données de sauvegarde et message de succès, sinon on créé un message d'erreur
    if(!isset($_SESSION['user'])){
        // l'array "user" contiendra toutes les données de l'utilisateur connecté
        $_SESSION['user'] = [
            'firstname' => 'Emile',
            'lastname' => 'Louis'
        ];
        $success = 'Vous êtes bien connecté !';
    } else {
        $error = 'Vous êtes déjà connecté !';
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
include 'menu.php';
?>
     <h1>Create</h1>

<?php
    if(isset($success)){
        echo $success;
    }
    if(isset($error)){
        echo $error;
    }
?>
</body>
</html>