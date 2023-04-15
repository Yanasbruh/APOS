<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="login/style.css" type="text/css">
</head>

<body>

<div class="login">
    <div class="left">
        <p style="color:#fff; font-size:1.5rem;">Silahkan Log in</p>
    <form method="POST" action="login/proses_login.php">
            <input type="text" autocomplete="off" placeholder="username/nis" name="username" required><br><br>
            <input type="password" placeholder="password" name="password" required><br><br>
            <input type="submit" class="button" value="Log In" id="submit">
        </form>
    </div>
    <div class="right">
        <img src="login/bg-login.svg">
    </div>
</div>

</body>

</html>