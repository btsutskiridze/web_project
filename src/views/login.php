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
            <input class="user-box-input" type="email" name="email" required>
            <label class="user-box-label">Username</label>
        </div>
        <div class="user-box">
            <input class="user-box-input" type="password" name="password" required>
            <label class="user-box-label">Password</label>
        </div>
        <button type="submit" class="login-box-button">
            Login
        </button>
    </form>
</div>
</body>
</html>


