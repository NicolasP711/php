<?php

    // 1er étape : Appel des variables (autant de isset que de champs dans le formulaires sauf certaines exceptions (champs optionnels par exemple)
    if(
        isset($_POST['firstname']) &&
        isset($_POST['lastname']) &&
        isset($_POST['age'])
    ){
        echo 'Toutes mes variables sont présentes';

        // 2ème étape : bloc des vérifs (autant de blocs que de champs, 1 champ = 1 structure conditionnelle)

        if(mb_strlen($_POST['firstname']) < 2 || mb_strlen($_POST['firstname']) > 50){
            $errors[] = 'Prénom pas bon !';
        }

        if(mb_strlen($_POST['lastname']) < 2 || mb_strlen($_POST['lastname']) > 50){
            $errors[] = 'Nom pas bon !';
        }

        if(!is_numeric($_POST['age']) || $_POST['age'] < 0 || $_POST['age'] > 150 || !ctype_digit($_POST['age'])){
            // $_POST['age'] = intval($_POST['age']); (METHODE ALTERNATIVE, l'autre est mieux (ctype_digit))
            $errors[] = 'Age pas bon !';
        }

        // 3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
        if(!isset($errors)){

            // Création du message de succès en mettant la version protégée des données (sinon faille XSS)
            $successMessage = 'Bonjour ' . htmlspecialchars($_POST['firstname']) . ' ' . htmlspecialchars($_POST['lastname']) . ' Tu as ' . htmlspecialchars($_POST['age']) . ' ans !';
        }
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
        // Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
        if(isset($errors)){
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }
        // Si la variable $successMessage existe, alors on l'affiche, sinon on affiche le formulaire dans le else
        if(isset($successMessage)){
            echo '<p style="color:green;">' . $successMessage . '</p>';
        } else {
            ?>
                <form action="" method="POST">
                    <input type="text" placeholder ="Prénom" name="firstname">
                    <input type="text" placeholder ="Nom" name="lastname">
                    <input type="text" placeholder ="Age" name="age">
                    <input type="submit">
                </form>
            <?php
        }
    ?>
</body>
</html>