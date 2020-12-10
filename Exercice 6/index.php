<?php
$firstnames = ['Nicolas', 'Jean', 'Aurelie', 'Lucas', 'Thomas', 'Martine', 'Baptiste', 'François', 'Guy', 'Renée'];
$i = 0;
$arrayLength = count($firstnames);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <ul>
       <?php
            while($i < $arrayLength){
                echo '<li> ' . $firstnames[$i] . ' </li>';
                $i++;
            }
       ?>
    </ul>
    <!-- for($i = 0; $i < arrayLength; $i++){
        echo '<li>' . $firstnames[$i] . '</li>';
    } -->
</body>
</html>