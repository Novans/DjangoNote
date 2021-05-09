<!DOCTYPE html>
<html lang="en" dir="ltr">

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

    session_start();

    $index = $_POST["index"];

    /*
Keterangan index pada variabel $_SESSION["note"]:
0 = nomor index, ini cuman dipake sebagai id
1 = judul
2 = isi
*/

    echo '<h3>File dengan judul ' . $_SESSION["note"][$index + 1][1] . ' berhasil dihapus</h3>
    <form action="home.php">
        <input type="submit" value="Home">
    </form>';

    $_SESSION["note"][$index + 1][3] = false;
    unlink('note/note' . $index . '.php');
    ?>
</body>

</html>