<?php
    //Appel des variables
    if(isset($_POST['email']) &&
       isset($_POST['pseudo']) &&
       isset($_POST['password']) &&
       isset($_POST['birthdate'])
    ){
        // Blocs des vérifs
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'format email pas bon !';
        }

        if(!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', $_POST['birthdate'])){
            $errors[] = 'date de naissance pas bon jj-mm-aaaa';
        }

        if(!preg_match('/^[A-Z0-9\'a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\-]{2,25}$/', $_POST['pseudo'])){
            $errors[] = 'Pseudo pas bon entre 2 et 25 caractères !';
        }

        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/
        ', $_POST['password'])){
            $errors[] = 'Mauvais mot de passe entre 8 et 4096 caractères !';
        }

        // Si pas d'erreur
        if(!isset($errors)){
            $successMsg = 'Bravo, tout est bon';
        }


     };
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

     if(isset($errors)){
         foreach($errors as $error){
             echo '<p style="color:red;">' . $error . '</p>';
         }
     }

     // Si succès alors on affiche un message et on cache le formulaire
     if(isset($successMsg)){
         echo  '<p style="color:green;">' . $successMsg . '</p>';
     } else {
         ?>
            <form action="index.php" method="POST">
            <input type="text" name="email" placeholder="email">
            <input type="text" name="pseudo" placeholder="pseudo">
            <input type="password" name="password" placeholder="password">
            <input type="text" name="birthdate" placeholder="birthdate">
            <input type="submit">
            </form>
         <?php
        }

    ?>

</body>
</html>