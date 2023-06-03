<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Module/Core/ini.php';

$users = DB::getInstance()->get('users')->results();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
<div>

    <?php
    if (!$users) {
        var_dump('error');
    } else {
        echo '<pre>';
        var_dump($users);
        echo '</pre>';

    }

    ?>

</div>

</body>
</html>


