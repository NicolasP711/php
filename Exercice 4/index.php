<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <ul>
        <?php

        $i = 0;

        // Tant que $i plus petit que 5000, on boucle
        while($i < 5000){
            $i++;
            echo '<li> ' . $i . '</li>';
        }

        ?>
    </ul>
</body>
</html>