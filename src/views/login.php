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
<div class="auth-box">
    <h2 class="heading-auth-box">Login</h2>
    <form method="POST" autocomplete="off">
        <div class="user-box">
            <label for='email' class="user-box-label">Email</label>
            <input id='email' type="email" name="email" required class="user-box-input">
        </div>
        <div class="user-box">
            <label for='password' class="user-box-label">Password</label>
            <input id='password' type="password" name="password" required class="user-box-input">
        </div>
        <button type="submit" class="login-box-button">
            Login
        </button>
    </form>
    <a href="register" class="base-link">Don't have an account? Register</a>
</div>
</body>
</html>

