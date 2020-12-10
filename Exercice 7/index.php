<?php

$usersInfos = [
    'name' => 'Nicolas',
    'country' => 'France',
    'city' => 'Marseille',
    'age' => '23',
    'mail' => 'aa@aa.aa',
];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    span{
        color: red;
        font-weight: bold;
    }

    </style>
</head>
<body>
    <?php

    echo 'Le nom de l utilisateur est <span class="red">' . $usersInfos['name'] . '</span> dans le pays <span class="red">' . $usersInfos['country'] . '</span> dans la ville de <span class="red">' . $usersInfos['city'] . ' </span> qui a l age <span class="red">' . $usersInfos['age'] . '</span> qui a pour mail <span class="red">' . $usersInfos['mail'].'</span>';

    ?>
</body>
</html>