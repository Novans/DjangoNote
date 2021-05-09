<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Tab</title>
    <style>
        body {
            font-family: sans-serif;
            background: #34495e;
        }

        td {
            width: 900px;
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(odd) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
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
    </style>
</head>

<body>
    <table class="content-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            error_reporting(0);
            session_start();

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

            /*
        Keterangan index pada variabel $_SESSION["note"]:
        0 = nomor index, ini cuman dipake sebagai id
        1 = judul
        2 = isi
        */

            $count = $_SESSION["count"];
            if (isset($_SESSION["note"])) {
                foreach ($_SESSION["note"] as $key => $value) {
                    if (!is_null($value[1]) && isset($value[1]) && $value[3]) {
                        echo "<tr>
                        <td>
                        $value[1]
                    </td>
                    <td>
                        <form action=\"note" . "/" . "note$value[0].php\">
                            <input type=\"submit\" value=\"Lihat\">
                        </form>
                        <form action=\"delete.php\" method=\"post\">
                            <input type=\"hidden\" name=\"index\" value=\"$value[0]\">
                            <input type=\"submit\" value=\"Hapus\">
                        </form>
                    </td>
                    <tr>";
                    }
                }
            } else {
                $_SESSION["note"] = array();
            }
                ?>
        </tbody>

    </table>

    <form action="add.php" method="post">
        <input type="submit" value="Tambah">
    </form>
    <form action="profile.php" method="post">
        <input type="submit" value="Profil">
    </form>

</body>

</html>