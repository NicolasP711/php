<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $errorFirstname = '<p style="color:red;">Le prénom doit avoir entre 2 et 50 caractères !</p>';
    $errorLastname = '<p style="color:red;">Le nom doit avoir entre 2 et 50 caractères !</p>';
    $errorAge = '<p style="color:red;">"L\'âge doit être un nombre entre 0 et 150 !"</p>';
    $goodResponse = '<p style="color:green;"> Bonjour ' . $_POST['firstname'] . $_POST['lastname'] . ' tu as ' . $_POST['age'] . ' ans </p>';
?>


<?php
    if (mb_strlen($_POST['firstname']) >= 2 && mb_strlen($_POST['firstname']) <= 49){
       echo htmlspecialchars($goodResponse);
    }
    else{
        echo htmlspecialchars($errorFirstname);
    }
    if (mb_strlen($_POST['lastname']) >= 2 && mb_strlen($_POST['lastname']) <= 49){
        echo htmlspecialchars($goodResponse);
     }
     else{
         echo htmlspecialchars($errorLastname);
     }
     if (is_numeric($_POST['age']) && $_POST['age'] >= 0 && ($_POST['age']) <= 150){
        $_POST['age'] = intval($_POST['age']);
        echo htmlspecialchars($goodResponse);
     }
     else{
        echo htmlspecialchars($errorAge);
     }

     var_dump($_POST);

?>
    <form action="" method="POST">
    <input type="text" name="firstname">
    <input type="text" name="lastname">
    <input type="text" name="age">
    <input type="submit">


    </form>
</body>
</html>