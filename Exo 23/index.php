<?php
    // Appel des variables

    if(isset($_FILES['photo']) && isset($_POST['email'])){

        $fileErrorCode = $_FILES['photo']['error'];

        //Bloc des verifs

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = "Adresse email pas bonne !";
        }

        if($fileErrorCode == 1 || $fileErrorCode == 2 || $_FILES['photo']['size'] > 5000000){
            $errors[] = 'Fichier trop grand';
        }else if($fileErrorCode == 3){
            $errors[] = 'Mauvaise Co !';
        }else if ($fileErrorCode == 4){
            $errors[] = 'Aucun fichier envoyé !';
        }else if ($fileErrorCode == 6 || $fileErrorCode == 7 || $fileErrorCode == 8){
            $errors[] = 'Problème serveur ré-éssayez plus tard !';
        }else if($fileErrorCode != 0){
            $errors[] = 'Problème, veuillez ré-éssayer plus tard !';
        }


        if(!isset($errors)){

            $allowedMIMEType = ['image/jpeg', 'image/png', 'image/gif'];

            $photoMIMEType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['photo']['tmp_name']);

            if(!in_array($photoMIMEType, $allowedMIMEType)){
                $errors[] = 'L\'image doit être un jpg un png ou un gif';
            }

            if(!isset($errors)){

                if($photoMIMEType == 'image/jpeg'){
                    $newPhotoExtension = 'jpg';
                } else if($photoMIMEType == 'image/png'){
                    $newPhotoExtension = 'png';
                } else if($photoMIMEType = 'images/gif'){
                    $newPhotoExtension = "gif";
                }

                do{
                    $newPhotoName = md5( time() . rand() ) . '.' . $newPhotoExtension;

                } while(file_exists('images/' . $newPhotoName));

                move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $newPhotoName);

                $success = 'Image bien ajoutée !';

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
</head>
<body>
<?php

    // Si il y a des erreurs, les afficher
    if(isset($errors)){
        foreach($errors as $error)
        echo '<p style="color:red;">' . $error . '</p>';
    }

    if(isset($success)){
        echo '<p style="color:green;">' . $success . '</p>';
    }

?>
    <form action="index.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
        <input type="file" name="photo" accept="image/jpeg, image/png, image/gif">
        <input type="text" name="email" placeholder="email">
        <input type="submit">

    </form>
</body>
</html>