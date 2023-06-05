<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="src/css/AuthPages.css" rel="stylesheet">
    <link href="src/css/popup.css" rel="stylesheet">
</head>
<body class="auth-page">
<?php if (Session::exists('success')): ?>
    <div class="popup-background">
        <div class="popup-box">
            <h2 class="popup-message-heading">Message</h2>
            <p class="popup-message-text"><?= Session::flash('success') ?></p>
            <a href="login" class="popup-button base-link">Login</a>
        </div>
    </div>
<?php endif; ?>

<div class="auth-box">
    <h2 class="heading-auth-box">Registration</h2>
    <form method="POST" action="/register" autocomplete="off">
        <div class="user-box">
            <label for='username' class="user-box-label">Username</label>
            <input id='username' type="text" name="username" value="<?= Input::get('username') ?>"
                   class="user-box-input">
            <?php if ($errors['username']): ?>
                <span class="error-message"><?= $errors['username'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <label for='email' class="user-box-label">Email</label>
            <input id='email' type="text" name="email" value="<?= Input::get('email') ?>"
                   class="user-box-input">
            <?php if ($errors['email']): ?>
                <span class="error-message"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <label for='password' class="user-box-label">Password</label>
            <input id='password' type="password" name="password" class="user-box-input">
            <?php if ($errors['password']): ?>
                <span class="error-message"><?= $errors['password'] ?></span>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <label for='password' class="user-box-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="user-box-input">
            <?php if ($errors['confirm_password']): ?>
                <span class="error-message"><?= $errors['confirm_password'] ?></span>
            <?php endif; ?>
        </div>

        <input type="hidden" name="token" value="<?= Token::generate() ?>">
        <button type="submit" name='register' class="login-box-button">
            Register
        </button>
    </form>
    <a href="login" class="base-link">Already have an account? Login</a>
</div>
<script src="src/js/popup.js"></script>
</body>
</html>


