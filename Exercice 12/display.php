<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_GET['firstname']) && isset($_GET['email'])) {
        echo 'Bonjour ' . htmlspecialchars($_GET['firstname']) . ' ton adresse email est ' . htmlspecialchars($_GET['email']);
    }else{
     echo 'Veuillez passer par le fomulaire';
    }
?>
</body>
</html>


