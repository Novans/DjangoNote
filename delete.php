<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

?>

    <head>
        <meta charset="utf-8">
        <title>Delete form</title>
        <style>
            body {
                font-family: sans-serif;
                background: #34495e;
            }

            input[type="submit"] {
                border: 0;
                background: white;
                display: block;
                margin: 20px auto;
                text-align: center;
                border: 2px solid #009879;
                padding: 5px 10px;
                outline: none;
                color: black;
                border-radius: 24px;
                transition: 0.25s;
                cursor: pointer;
            }

            h3 {
                display: block;
                font-size: 1.17em;
                text-align: center;
                font-weight: bold;
                color: Tomato;
            }
        </style>
    </head>

    <body>
        <?php

        //error_reporting(0);

        $Judul = $_SESSION["noteData"][$_POST['indexNote']][0];

        include_once("control.php");
        $model = new control();

        $model->deleteNoteData($_SESSION["username"], $Judul);

        echo '<h3>File dengan judul ' . $Judul . ' berhasil dihapus</h3>
    <form action="home.php">
        <input type="submit" value="Home">
    </form>';
        ?>
    </body>

<?php
}

?>

</html>