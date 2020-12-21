<?php
    // Appel des variables
    if(
        isset($_GET['search'])
    ){

        // Blocs des vérifs
        if(mb_strlen($_GET['search']) < 1 || mb_strlen($_GET['search']) > 50){
            $error = 'Le recherche doit comprendre entre 1 et 50 caractères !';
        }

        // Si pas d'erreurs
        if(!isset($error)){

            // Connexion à la base de données
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème avec la base de données' . $e->getMessage());
            }

            // Récupération des fruits dont le nom contient la recherche envoyée par le formulaire
            $searchFruits = $bdd->prepare("SELECT * FROM  fruits WHERE `name` LIKE ? ");

            // On envoie les % dans le execute concaténés à la recherche et non pas dans la requête SQL directement, sinon, ça marche pas
            $searchFruits->execute([
                '%' . $_GET['search'] . '%',
            ]);

            // Récupération de tous les résultats de la requête SQL sous forme d'array associatif
            $fruits = $searchFruits->fetchAll(PDO::FETCH_ASSOC);

            // Fermeture de la requête
            $searchFruits->closeCursor();

            // Si il n'y a pas de fruits trouvés, erreur
            if(empty($fruits)){
                $error = 'Aucun résultat pour cette recherche';
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table tr td, table tr th{
            border: 1px solid black;
            padding: 5px 10px;
        }
        table{
            border-collapse : collapse;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Votre recherche...">
        <input type="submit">
    </form>

    <?php

    if(isset($error)){
            echo '<p style="color:red;">' . $error . '</p>';
    }

    if(!empty($fruits)){
        echo '<p> il y a ' . count($fruits) . ' résultat(s) dans votre recherche"' . htmlspecialchars($_GET['search']) . '"</p>';
    ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Origine</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($fruits as $fruit){
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars(ucfirst($fruit['name'])) . '</td>';
                        echo '<td>' . htmlspecialchars($fruit['color']) . '</td>';
                        echo '<td>' . htmlspecialchars(ucfirst($fruit['origin'])) . '</td>';
                        echo '<td>' . htmlspecialchars($fruit['price']) . '€</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    <?php
    }

    ?>


</body>
</html>