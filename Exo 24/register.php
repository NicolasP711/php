<?php

    // Inclusion de la fonction permettant de vérifier si le captcha est valide ou pas
    require 'recaptchaValid.php';

    // Appel des variables
    if(
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['password_confirmation']) &&
        isset($_POST['g-recaptcha-response'])
    ){
        // Bloc des vérifs
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email invalide !';
        }

        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,60}$/', $_POST['password'])){
            $errors[] = 'Le mot de passe doit contenir entre 8 et 60 caractères dont 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial !';
        }

        if($_POST['password_confirmation'] != $_POST['password']){
            $errors[] = 'La confirmation ne correspond pas au mot de passe';
        }

        // Vérification du captcha
        if(!recaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
            $errors[] = 'Veuillez remplir correctement le captcha !';
        }

        // Si pas d'erreur
        if(!isset($errors)){

            // Connexion à la BDD
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

            } catch(Exception $e){
                die('Problème avec la base de données' . $e->getMessage());
            }

            // Second bloc de vérif (si email pas déjà pris), pour vérifier si le compte existe, il suffit de faire un select avec l'email
            $checkIfExists = $bdd->prepare('SELECT * FROM accounts WHERE email = ?');

            $checkIfExists->execute([
                $_POST['email']
            ]);
            $account = $checkIfExists->fetch(PDO::FETCH_ASSOC);

            // Si $account n'est pas vide, ça veux dire qu'un compte a été trouvé, donc message d'erreur
            if(!empty($account)){
                $errors[] = 'Cette adresse mail est déjà prise, veuillez en saisir une autre !';
            }

            if(!isset($errors)){

                // Requête pour ajouter un compte à la BDD (requête préparée pour protéger des injections SQL car il y a des variables dedans)
                $response = $bdd->prepare("INSERT INTO accounts(email, `password`, register_date) VALUES (?, ?, ?) ");

                // Exécution de la requête
                $response->execute([
                    $_POST['email'], // Email envoyé dans le formulaire donc $_POST['email']
                    password_hash($_POST['password'], PASSWORD_BCRYPT),
                    date('Y-m-d H:i:s'), // On stocke la date au moment de l'exécution
                ]);

                if($response->rowCount() > 0){
                    $successMsg = 'Le compte a bien été créé !';
                }else {
                    $errors[] = 'Problème interne au site veuillez ré-essayer plus tard';
                }

                // Fermeture de la requête
                $response->closeCursor();
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
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<?php

    // Si il ya des erreurs, les afficher
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Sinon message de succès et on cache le formulaire
    if(isset($successMsg)){
        echo '<p style="color:green;">' . $successMsg . '</p>';
    } else {

        ?>
            <form action="register.php" method="POST">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="password_confirmation" placeholder="password_confirmation">
                <div class="g-recaptcha" data-sitekey="6LeHihAaAAAAAAE726cgSEocWQJOJ43i9IW77hN2"></div>
                <input type="submit">
            </form>

        <?php
    }
?>

</body>
</html>