<?php
$admin = false;
$colorText = 'red';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    b{
        color: <?php echo $colorText; ?>;
    }

    </style>
</head>
<body>
    <?php


        if($admin){
            echo '<p>Tu es le bienvenu<a href="https://google.com" target="_blank"> va sur Google</a></p>';
        } else{
            echo '<b>Vire de là</b>';
        }

    ?>
</body>
</html>