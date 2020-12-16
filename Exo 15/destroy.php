<?php
// Obligatoire pour avoir accès aux sessions
session_start();
// Supprime l'array dans la session, sans supprimer toute la session comme le ferais un session_destroy();
// La suppression de l'array est en fait une déconnexion de l'utilisateur
unset($_SESSION['user']);
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
    <h1>Destroy</h1>
    <p>Vous êtes bien déconnecté.</p>
</body>
</html>