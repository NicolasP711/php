<?php
    // Connexion à la base de données
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

    } catch(Exception $e){
        // Si la connexion à échoué, le die() stop la page et affiche un message
        die('Problème avec la base de données' . $e->getMessage());
    }

    //Si $_GET['color'] existe dans l'url, alors on cherchera tous les fruits de cette couleur, sinon on récupèrera tous les fruits (dans le else)
    if(isset($_GET['color'])){

        // Requête pour récupérer tous les fruits dont la couleur est celle présente dans l'URL (requête préparée car on a une variable PHP dans la requête)
        $response = $bdd->prepare("SELECT * FROM fruits WHERE color = ?");
        $response->execute([
            $_GET['color']
        ]);

    } else {
        //Requête pour récupérer tous les fruits
        $response = $bdd->query('SELECT * from fruits');

    }

    // Récupération des fruits sous forme d'arrays associatifs
    $fruits = $response->fetchAll(PDO::FETCH_ASSOC);

    // Fermeture de la requête
    $response->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" methos="GET">
        <input type="text" name="color">
        <input type="submit">
    </form>
        <?php

            // Si il y a des fruits à afficher, on les affiche dans une liste ul li, sinon message d'erreur
            if(!empty($fruits)){
                echo '<ul>';

                //Chaque fruit sera dans un li
                foreach($fruits as $fruit){
                    echo '<li>' . htmlspecialchars($fruit['name']) . ' ' . htmlspecialchars($fruit['color']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>Aucun fruit à afficher !</p>';
            }
        ?>

</body>
</html>