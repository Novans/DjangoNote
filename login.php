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
$textAlert = "";

if (isset($_POST["username"]) and isset($_POST["password"])) {

    if ($model->checkUsername($_POST["username"]) == 0) {
        session_start();

        $model->setData($_POST["username"], $_POST["password"]);
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        header("Location: home.php");
        exit;
    } else {
        if (($model->getPassword($_POST["username"])->fetch_row()[0]) != ($_POST["password"])) {
            $textAlert = "Username dan Kata Sandi tidak tepat";
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