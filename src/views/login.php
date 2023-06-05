<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="src/css/AuthPages.css" rel="stylesheet">
</head>
<body class="auth-page">
<?php if (Session::exists('message')): ?>
    <div class="popup-background">
        <div class="popup-box">
            <h2 class="popup-message-heading">Message</h2>
            <p class="popup-message-text"><?= Session::flash('message') ?></p>
        </div>
    </div>
    <script src="src/js/popup.js"></script>
<?php endif; ?>
<div class="auth-box">
    <h2 class="heading-auth-box">Login</h2>
    <form action="login" method="POST" autocomplete="off">
        <div class="user-box">
            <label for='email' class="user-box-label">Email</label>
            <input id='email' type="text" name="email" value="<?= Input::get('email') ?>" class="user-box-input">
            <?php if (isset($errors['email'])): ?>
                <p class="error-message"><?= $errors['email'] ?></p>
            <?php endif; ?>
        </div>
        <div class="user-box">
            <label for='password' class="user-box-label">Password</label>
            <input id='password' type="password" name="password" class="user-box-input">
            <?php if (isset($errors['password'])): ?>
                <p class="error-message"><?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>
        <input type="hidden" name="token" value="<?= Token::generate() ?>">
        <button type="submit" class="login-box-button">
            Login
        </button>
    </form>
    <a href="register" class="base-link">Don't have an account? Register</a>
</div>
</body>
</html>

