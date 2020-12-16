<?php
session_start();
 if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
     $success = 'Bonjour ' . htmlspecialchars($_SESSION['firstname']) . htmlspecialchars($_SESSION['lastname']);
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