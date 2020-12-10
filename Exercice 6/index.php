<?php
$firstnames = ['Nicolas', 'Jean', 'Aurelie', 'Lucas', 'Thomas', 'Martine', 'Baptiste', 'François', 'Guy', 'Renée'];
$i = 0;
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
            while($i < 10){
                echo '<li> ' . $firstnames . ' </li>';
                $i++;
            }
        ?>
    </ul>

</body>
</html>