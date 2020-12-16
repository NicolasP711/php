<?php

    session_start();
    if(!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])){
        $_SESSION['firstname'] = 'Emile';
        $_SESSION['lastname'] = 'Louis';
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