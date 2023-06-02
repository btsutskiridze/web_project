<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Modules/Core/ini.php';

$user = DatabaseService::getInstance()->query('SELECT username FROM users WHERE username = ?', ['bakari']);

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

<pre>
        <?php
        if ($user->error())
            var_dump('error');
        else
            var_dump($user);
        ?>
</pre>

</div>

</body>
</html>


