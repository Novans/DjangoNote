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

if (isset($_POST["username"]) and isset($_POST["password1"]) and isset($_POST["password2"])) {

    if ($model->checkUsername($_POST["username"]) == 0) {
        if ($_POST["password1"] == $_POST["password2"]) {
            session_start();

            $model->setData($_POST["username"], $_POST["password1"]);
            header("Location: home.php");
            exit;
        } else {
            echo "<script>alert('Password yang dimasukkan tidak sama')</script>";
        }
    } else {
        echo "<script>alert('User sudah terdaftar')</script>";
    }
}
?>

<body>
    <div class="box">

        <form method="post">
            <h1>Register</h1>
            <input type="text" name="username" placeholder="Username" required maxlength="100">
            <input type="password" name="password1" placeholder="Password" required maxlength="100">
            <input type="password" name="password2" placeholder="Confirm Password" required maxlength="100">
            <p style="color: white;">
            </p>
            <input name="register" type="submit" value="Register">
        </form>
        <form action="login.php" method="post">
            <input type="submit" style="border: 2px solid lightslategray;" value="Login">
        </form>
    </div>
</body>

</html>