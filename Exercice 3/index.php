<?php

$admin = true;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .error{
        color: red;
        font-weight: bold;
    }
    </style>
</head>
<body>

    <?php

    if($admin){

        ?>
        <p>Bonjour Admin ! Clique <a href="#">sur ce lien</a> pour gérer le site !</p>
        <?php

    }   else{

        ?>
        <p class="error">Erreur, vous n'êtes pas admin!</p>
        <?php
    }
    /*
        Méthode moins bien

        if($admin){
                echo '<p>Tu es le bienvenu<a href="https://google.com" target="_blank"> va sur Google</a></p>';
            } else{
                echo '<p class="error">Vire de là</p>';
            }
    */
    ?>

</body>
</html>