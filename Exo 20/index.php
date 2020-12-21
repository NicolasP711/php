<?php
    if(
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['password_confirmation'])
    ){

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'format email pas bon !';
        }

        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,60}$/', $_POST['password'])){
            $errors[] = 'Mauvais mot de passe entre 8 et 4096 caractères !';
        }

        if($_POST['password_confirmation'] != $_POST['password']){
            $errors[] = 'Mot de passe NON confirmé';
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
                <input type="submit">
            </form>

        <?php
    }
?>

</body>
</html>