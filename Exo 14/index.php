<?php
    if(isset($_POST['color'])){
        $cookieColor = $_POST['color'];
        setcookie('colorCookie', $cookieColor, time() + 24 * 3600, null, null, false, true);
        if(mb_strlen($_POST['color']) < 2 || mb_strlen($_POST['color']) > 10){
            echo 'Mauvais code couleur !';
        }
        if(!isset($error)){
            echo '<body style="background-color:' . htmlspecialchars($cookieColor) . ';"></body>';
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
    <form action="" method="POST">
    <input type="text" name="color">
    <input type="submit">
    </form>
</body>
</html>