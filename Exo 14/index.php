<?php

    // Par défaut on assigne la couleur grise à $newColor pour éviter d'avoir une couleur vide dans les cas où il n'y a pas de formulaire ou de cookie.
    $newColor = 'grey';

    // Si le cookie de sauvegarde de la couleur existe, $newColor prendra la couleur stockée dedans
    if(isset($_COOKIE['backgroundColor'])){
        $newColor = $_COOKIE['backgroundColor'];
    }

    // Appel des variables
    if(isset($_POST['color'])){

        // Bloc des verifs
        if(mb_strlen($_POST['color']) < 2 || mb_strlen($_POST['color']) > 10){
            $error = 'Vous devez remplir le champ de couleur';
        }

        // Si pas d'erreur
        if(!isset($error)){

            // $newColor contiendra la couleur qui est envoyée par le formulaire
            $newColor = $_POST['color'];

            // On crée un nouveau cookie avec la nouvelle couleur
            setcookie('backgroundColor', $_POST['color'], time() + 24 * 3600,null, null, false, true);
        }
    }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color:<?php echo htmlspecialchars($newColor); ?>;">
    <form action="index.php" method="POST">
    <input type="color" name="color">
    <input type="submit">
    </form>

    <?php

    // Si le message d'erreur existe, on l'affiche
    if(isset($color)){
        echo '<p style="color:red;" </p>';
    }

    ?>
</body>
</html>