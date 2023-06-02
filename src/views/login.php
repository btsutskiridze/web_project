<?php require_once '../../Modules/Core/ini.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="../css/login.css" rel="stylesheet">
</head>
<body class="login-page">
<div class="login-box">
    <h2 class="heading-login-box">Login</h2>
    <form method="POST">
        <div class="user-box">
            <input id='email' type="email" name="email" required class="user-box-input">
            <label for='email' class="user-box-label">Username</label>
        </div>
        <div class="user-box">
            <input id='password' type="password" name="password" required class="user-box-input">
            <label for='password' class="user-box-label">Password</label>
        </div>
        <button type="submit" class="login-box-button">
            Login
        </button>
    </form>
</div>
</body>
</html>


