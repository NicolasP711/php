<?php

    // Appel des variables
    if(
        isset($_POST['age']) &&
        isset($_POST['email']) &&
        isset($_POST['link'])
    ){

        // Bloc des vérifs

        // Doit être soit un chiffre, soit plus grand que 0, soit plus grand que 150 pour créer une erreur
        if(!filter_var($_POST['age'], FILTER_VALIDATE_INT) || $_POST['age'] < 0 || $_POST['age'] > 150){
            $errors[] = 'Age pas bon';
        }

        // Doit être un email invalide (d'où le "!" pour inverser le sens) pour créer une erreur
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'email pas bon';
        }

        // Idem pour l'URL
        if(!filter_var($_POST['link'], FILTER_VALIDATE_URL)){
            $errors[] = 'lien pas bon';
        }

        // Si pas d'erreur
        if (!isset($errors)){

            // Message affiché plus bas dans la page
            $success = 'Merci pour toutes ces précieuses infos !';
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
<body>

<?php

    // Si il y a des erreurs, on les affiche avec un foreach
    if(isset($errors)){

        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Affichage du message de succès
    if(isset($success)){
        echo '<p style="color:green;">' . $success . '</p>';
    }else{
        ?>
            <form action="index.php" method="POST">
                <input type="text" name="age">
                <input type="text" name="email">
                <input type="text" name="link">
                <input type="submit">
            </form>
        <?php
    }


?>

</body>
</html>