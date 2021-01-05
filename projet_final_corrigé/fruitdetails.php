<?php

// Inclusion du fichier des fonctions
require 'core/functions.php';

// Appel de la variable
if(
    isset($_GET['id'])
){

    // Bloc de verif
    if(!preg_match('/^[1-9][0-9]{0,10}$/', $_GET['id'])){
        $error = 'URL invalide !';
    }

    if(!isset($error)){

        // Connexion à la bdd
        $bdd = connectDb();

        // Requête avec une jointure pour récupérer les infos du fruit passé dans l'URL ainsi que le nom de son créateur.
        // L'alias "as" permet de donner un nom différent au champ du nom du créateur qui sera "user_pseudonym" au lieu de "pseudonym" dans l'array PHP
        $getFruits = $bdd->prepare('SELECT fruits.*, users.pseudonym as user_pseudonym FROM fruits INNER JOIN users ON fruits.user_id = users.id WHERE fruits.id = ?');

        $getFruits->execute([
            $_GET['id']
        ]);

        // Récupération du fruit sous forme d'array PHP associatif
        $fruit = $getFruits->fetch(PDO::FETCH_ASSOC);

        if(empty($fruit)){
            $error = 'Ce fruit n\'existe pas !';
        }

    }

} else {
    $error = 'URL invalide !';
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche fruit - Wikifruit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <?php include 'core/partials/topmenu.php'; ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 py-5">
                <h1 class="pb-4">Fiche Fruit</h1>
                <p class="pb-4"><a href="listfruits.php">Revenir à la liste des fruits</a></p>

                <?php

                if(isset($error)){
                    echo '<p class="alert alert-danger text-center">' . $error . '</p>';
                } else {
                    ?>
                        <div class="card">
                            <div class="card-header">
                                <h2><?php echo ucfirst(htmlspecialchars( $fruit['name'] )); ?></h2>
                            </div>
                            <div class="card-body">
                                <h3 class="h4 mb-4">Provenance : <?php echo ucfirst($fruitCountries[$fruit['origin']]); ?></h3>
                                <h3 class="h4">Description du fruit :</h3>
                                <p class="card-text"><?php echo htmlspecialchars( $fruit['description'] ); ?></p>
                                <p class="text-danger mb-0 mt-5">Ajouté par <?php echo htmlspecialchars( $fruit['user_pseudonym'] ); ?></p>
                            </div>
                        </div>
                    <?php
                }

                ?>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>