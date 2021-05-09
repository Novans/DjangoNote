<?php

session_start();

if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

    $_SESSION['inJudul'] = $_POST['judul'];
    $_SESSION['inIsi'] = $_POST['isi'];

    include_once("control.php");
    $model = new control();

    $model->updateNoteData($_SESSION['username'], $_SESSION["oldJudul"], $_SESSION['inJudul'], $_SESSION['inIsi']);

    echo "<script>alert('Note berhasil di update');
    window.location.replace('home.php');
    </script>";
}
