<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .box {
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: whitesmoke;
            text-align: center;
        }

        .box h1 {
            color: black;
            font-size: 20px;
        }

        .box textarea {
            background-color: whitesmoke;
            border: 2px solid lightsalmon;
        }

        .box input[type="text"],
        .box input[type="password"] {
            border-radius: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid lightsalmon;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            border-radius: 24px;
            transition: 0.25s;
        }

        .box input[type="submit"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: black;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    include_once("control.php");
    session_start();

    $model = new control();

    $excludedColors = array();
    $getExcludedColor = $model->getExcludedColors($_SESSION["username"]);
    foreach ($getExcludedColor as $value) {
        array_push($excludedColors, $value);
    }
    $colorsName = array();
    foreach ($excludedColors as $values) {
        if (str_contains($values, 'Muda')) {
            $values = str_replace("Muda", " Muda", $values);
        }
        array_push($colorsName, $values);
    }

    randomIndex();

    function randomIndex()
    {
        $files = file("color.csv");
        $len = count($files) - 1;
        $randomIndex = rand(0, $len);
        $csv = $files[$randomIndex];
        $data = str_getcsv($csv);
        global $colorsName;
        if (!str_contains($data[0], "Warna")) {
            if (in_array($data[0], $colorsName)) {
                randomIndex();
            } else {

    ?>

                <body style="background-color:<?php echo $data[1] ?>">
        <?php
            }
        } else {
            randomIndex();
        };
        // now do whatever you want with $data, which is one random row of your CSV
    };


        ?>

        <div class="box">
            <form action="builder.php" method="post">
                <h1>Judul Notes</h1>
                <input type="text" name="judul" id="judul">
                <h1>Isi</h1>
                <textarea name="isi" id="isi" cols="30" rows="10"></textarea>

                <input type="submit" value="Simpan">
            </form>
            <form method="post" action="home.php">
                <input type="submit" name="Kembali" value="Kembali">
            </form>
        </div>
                </body>

</html>