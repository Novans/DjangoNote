<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<?php
include_once("control.php");

$model = new control();

if (isset($_POST["username"]) and isset($_POST["password"])) {

    if ($model->checkUsername($_POST["username"]) == 0) {
        echo "<script>alert('Username tidak ditemukan')</script>";
        exit;
    } else {
        if (($model->getPassword($_POST["username"])->fetch_row()[0]) != ($_POST["password"])) {
            echo "<script>alert('Username dan Kata Sandi tidak tepat')</script>";
        } else {
            session_start();

            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            header("Location: home.php");
            exit;
        }
    }
}
?>

<body>
    <div class="box">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" required maxlength="100">
            <input type="password" name="password" placeholder="Password" required maxlength="100">
            <p style="color: white;">
            </p>
            <input type="submit" value="Login">
        </form>
        <form action="register.php" method="post">
            <input class="Register" type="submit" style="border: 2px solid lightslategray;" value="Register">
        </form>
    </div>

</body>

</html>