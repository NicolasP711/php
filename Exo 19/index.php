<?php
    // Appel des variables
    if(
        isset($_POST['name']) &&
        isset($_POST['color']) &&
        isset($_POST['origin']) &&
        isset($_POST['price'])
    ){

        // Blocs des vérifs
        if(mb_strlen($_POST['name']) < 2 || mb_strlen($_POST['name']) > 25){
            $errors[] = 'Le nom doit comprendre entre 2 et 25 caractères !';
        }

        if(mb_strlen($_POST['color']) < 2 || mb_strlen($_POST['color']) > 25){
            $errors[] = 'La couleur doit comprendre entre 2 et 25 caractères !';
        }

        if(mb_strlen($_POST['origin']) < 2 || mb_strlen($_POST['origin']) > 55){
            $errors[] = 'L\'origine doit comprendre entre 2 et 55 caractères !';
        }

        // Le prix doit être composé de 1 à 4 chiffres, suivi optionnellement d'une virgule ou d'un point puis de 1 ou 2 chiffres derrière la virgule
        if(!preg_match('/^[0-9]{1,4}([\.,][0-9]{1,2})?$/', $_POST['price'])){
            $errors[] = 'Le prix est invalide ! Maximum 9999.99 euros';
        }

        // Si pas d'erreurs
        if(!isset($errors)){

            // Connexion à la base de données
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème avec la base de données' . $e->getMessage());
            }

            // Requête préparée pour créer le nouveau fruit (requête préparée car il y a des variables PHP à mettre dedans, donc on se protège des injections SQL)
            $response = $bdd->prepare("INSERT INTO fruits(`name`, color, origin, price) VALUES (?, ?, ?, ?) ");

            // Execution de la requête en liant les 4 marqueurs à leurs variables PHP
            $response->execute([
                $_POST['name'],
                $_POST['color'],
                $_POST['origin'],
                str_replace(',', '.', $_POST['price']),     // Stockage en bdd du prix avec un point au lieu d'une virgule si il y en a une
            ]);

            // Si rowCount renvoie plus de 0, alors tout a fonctionné, sinon afficher message d'erreur
            if($response->rowCount() > 0){
                $successMsg = 'Le fruit a bien été créé !';
            }else {
                $errors[] = 'Problème interne au site veuillez ré-essayer plus tard';
            }

            $response->closeCursor();

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

    // Affichage des erreurs
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Affichage du message de succès si il existe, sinon formulaire
    if(isset($successMsg)){
        echo '<p style="color:green;">' . $successMsg . '</p>';
    } else {

        ?>
            <form action="index.php" method="POST">
                <input type="text" name="name" placeholder="nom">
                <input type="text" name="color" placeholder="couleur">
                <input type="text" name="origin" placeholder="origine">
                <input type="text" name="price" placeholder="prix">
                <input type="submit">
            </form>

        <?php
    }
?>

</body>
</html>