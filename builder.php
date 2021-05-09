<?php

session_start();

if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

    $_SESSION['inJudul'] = $_POST['judul'];
    $_SESSION['inIsi'] = $_POST['isi'];

    include_once("control.php");
    $model = new control();

    if ($model->checkJudul($_SESSION['username'], $_SESSION['inJudul']) == 0) {
        $model->addNote($_SESSION['username'], $_SESSION['inJudul'], $_SESSION['inIsi']);

        header("location: home.php");
    } else {
        echo "<script>alert('Note sudah ada');
    window.location.replace('add.php');
    </script>";
    }
}
