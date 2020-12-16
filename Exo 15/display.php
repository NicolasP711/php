<?php
// Obligatoire pour avoir accès aux sessions
session_start();

// Si l'array user existe (ce qui revient à dire que l'utilisateur est connecté), on affiche une phrase de bienvenue à l'utilisateur, sinon message l'invitant à se connecter
 if(isset($_SESSION['user'])){
     $success = 'Bonjour ' . htmlspecialchars($_SESSION['user']['firstname']) . htmlspecialchars($_SESSION['user']['lastname']);
 } else {
     $error = ' Veuillez vous connecter en cliquant sur la page <a href="create.php">create</a>';
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
    <h1>Display</h1>
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