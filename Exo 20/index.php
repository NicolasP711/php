<?php
    if(
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['password_confirmation']) &&
        isset($_POST['register_date'])
    ){

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'format email pas bon !';
        }

        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/', $_POST['password'])){
            $errors[] = 'Mauvais mot de passe entre 8 et 4096 caractères !';
        }

        if($_POST['password_confirmation'] != $_POST['password']){
            $errors[] = 'Mot de passe NON confirmé';
        }

        if(!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', $_POST['register_date'])){
            $errors[] = 'Mauvaise date';
        }

        if(!isset($errors)){

            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème avec la base de données' . $e->getMessage());
            }

            $response = $bdd->prepare("INSERT INTO accounts(email, `password`, register_date) VALUES (?, ?, ?) ");

            $response->execute([
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT),
                $_POST['register_date'] = date('Y-m-d H:i:s'),
            ]);

            if($response->rowCount() > 0){
                $successMsg = 'Le compte a bien été créé !';
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

    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    if(isset($successMsg)){
        echo '<p style="color:green;">' . $successMsg . '</p>';
    } else {

        ?>
            <form action="index.php" method="POST">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="password_confirmation" placeholder="password_confirmation">
                <input type="text" name="register_date" placeholder="register_date">
                <input type="submit">
            </form>

        <?php
    }
?>

</body>
</html>