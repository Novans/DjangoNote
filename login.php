<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
    <form class="box" action="login.php" method="post">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username" required maxlength="100">
        <input type="password" name="password" placeholder="Password" required maxlength="100">
        <p style="color: white;">
        </p>
        <input type="submit" value="Login">
        <input class="Register" type="submit" value="Register" style="border: 2px solid lightslategray;">
    </form>
</body>

</html>