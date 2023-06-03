<?php require_once '../../Module/Core/ini.php'; ?>
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
    <form method="POST" autocomplete="off">
        <div class="user-box">
            <input id='username' type="text" name="username" required class="user-box-input">
            <label for='username' class="user-box-label">Username</label>
        </div>
        <div class="user-box">
            <input id='email' type="email" name="email" required class="user-box-input">
            <label for='email' class="user-box-label">Email</label>
        </div>
        <div class="user-box">
            <input id='password' type="password" name="password" required class="user-box-input">
            <label for='password' class="user-box-label">Password</label>
        </div>
        <div class="user-box">
            <input type="password" name="confirm_password" required class="user-box-input">
            <label for='password' class="user-box-label">Confirm Password</label>
        </div>
        <button type="submit" class="login-box-button">
            Login
        </button>
    </form>
    <a href="login.php" class="base-link">Already have an account? Login</a>

</div>
</body>
</html>


