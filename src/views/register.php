<?php

require_once '../../Module/Core/ini.php';

$errors = [];

if (Input::exists()) {
    $validator = new Validator();

    $validator->setAttributes([
        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password',
        'confirm_password' => 'Password Confirmation'
    ]);

    $validation = $validator->check($_POST, [
        'username' => ['required' => true, 'min' => 2, 'max' => 20, 'unique' => 'users'],
        'email' => ['required' => true, 'min' => 2, 'max' => 60, 'unique' => 'users', 'email' => true],
        'password' => ['required' => true, 'min' => 6,],
        'confirm_password' => ['required' => true, 'matches' => 'password']
    ]);

    $validation->passed() ? header('Location: login.php') : $errors = $validation->errors();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="../css/AuthPages.css" rel="stylesheet">
</head>
<body class="login-page">
<div class="login-box">
    <h2 class="heading-login-box">Registration</h2>
    <form method="POST" action="" autocomplete="off">
        <!--        value="--><?php //= Input::get('username') ?><!--"-->
        <div class="user-box">
            <input id='username' type="text" name="username" value="<?= Input::get('username') ?>"
                   class="user-box-input">
            <label for='username' class="user-box-label">Username</label>
            <?php if ($errors['username']): ?>
                <span class="error-message"><?= $errors['username'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <input id='email' type="text" name="email" value="<?= Input::get('email') ?>"
                   class="user-box-input">
            <label for='email' class="user-box-label">Email</label>
            <?php if ($errors['email']): ?>
                <span class="error-message"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <input id='password' type="password" name="password" class="user-box-input">
            <label for='password' class="user-box-label">Password</label>
            <?php if ($errors['password']): ?>
                <span class="error-message"><?= $errors['password'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" class="user-box-input">
            <label for='password' class="user-box-label">Confirm Password</label>
            <?php if ($errors['confirm_password']): ?>
                <span class="error-message"><?= $errors['confirm_password'] ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" name='register' class="login-box-button">
            Login
        </button>
    </form>
    <a href="login.php" class="base-link">Already have an account? Login</a>

</div>
</body>
</html>


