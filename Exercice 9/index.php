<?php
$fruits = ['Pomme', 'Poire', 'Banane', 'Pasteque', 'Figue'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function print_rv2($elementToDisplay){
        return '<pre>' . $elementToDisplay . '</pre>';
    }
    echo print_rv2('Bonjour');
    ?>
</body>
</html>