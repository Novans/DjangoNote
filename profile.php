<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php

session_start();

if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

    include_once("control.php");

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

                <head>
                    <meta charset="utf-8">
                    <title>Profile</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: sans-serif;
                            background: #34495e;
                        }

                        input,
                        select,
                        textarea {
                            color: #ffff;
                        }

                        .box {
                            width: 300px;
                            height: 550px;
                            padding: 40px;
                            position: absolute;
                            bottom: 0%;
                            margin-top: 1.8%;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background: #333;
                            text-align: center;
                        }

                        .box1 input[type="submit"] {
                            border: 0;
                            background: none;
                            display: block;
                            margin: 20px auto;
                            text-align: center;
                            border: 2px solid #2ecc71;
                            padding: 14px 40px;
                            outline: none;
                            color: white;
                            border-radius: 24px;
                            transition: 0.25s;
                            cursor: pointer;
                        }

                        .box1 {
                            width: 300px;
                            padding: 40px;
                            position: relative;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background: #333;
                            text-align: center;
                        }

                        .box h1 {
                            color: white;
                            text-transform: uppercase;
                            font-weight: 500;
                        }

                        .box input[type="text"],
                        .box input[type="password"] {
                            border-radius: 0;
                            background: none;
                            display: block;
                            margin: 20px auto;
                            text-align: center;
                            border: 2px solid #3498db;
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
                            color: white;
                            border-radius: 24px;
                            transition: 0.25s;
                            cursor: pointer;
                        }

                        .topnav {
                            font-family: sans-serif;
                            background-color: #333;
                            overflow: hidden;
                        }

                        /* Style the links inside the navigation bar */
                        .topnav a {
                            float: left;
                            color: #f2f2f2;
                            text-align: center;
                            padding: 14px 16px;
                            text-decoration: none;
                            font-size: 17px;
                        }

                        /* Change the color of links on hover */
                        .topnav a:hover {
                            background-color: #ddd;
                            color: black;
                        }

                        /* Add a color to the active/current link */
                        .topnav a.active {
                            background-color: #04AA6D;
                            color: white;
                        }

                        @media screen and (max-width: 600px) {
                            .box {
                                width: 200px;
                                height: 81%;
                                padding: 40px;
                                position: absolute;
                                bottom: 0%;
                                margin-top: 1.8%;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background: #333;
                                text-align: center;
                            }

                            .box input[type="submit"] {
                                border: 0;
                                background: none;
                                display: block;
                                margin: 10px auto;
                                text-align: center;
                                border: 1px solid #2ecc71;
                                padding: 10px 30px;
                                outline: none;
                                color: black;
                                border-radius: 20px;
                                transition: 0.25s;
                                cursor: pointer;
                            }
                        }
                    </style>
                </head>

                <body style="background-color:<?php echo $data[1] ?>">
        <?php
            }
        } else {
            randomIndex();
        };
        // now do whatever you want with $data, which is one random row of your CSV
    };

    randomIndex();


        ?>

        <body>
            <div class="topnav">
                <a class="active" href="index.php">Home</a>
                <a href="add.php"> Add Note</a>
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
            <div class="box">
                <form method="post">
                    <img src="assets/profile-user.png" alt="Profile" width="120px">
                    <h2 style="color: white;"><?php echo $model->getUsername($_SESSION["username"])->fetch_row()[0] ?></h2>
                    <h4 style="color: white;">Warna yang dapat diperoleh :</h4>
                    <table style="margin-left: auto;margin-right: auto;">
                        <?php
                        $color = array();
                        $file = fopen('color.csv', 'r');
                        while (($line = fgetcsv($file)) !== FALSE) {
                            if ($line[0] != 'Warna') {
                                $colorName = str_replace(' ', '', $line[0]);
                                if (in_array($colorName, $excludedColors)) {
                        ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name=<?php echo $colorName ?> value=<?php echo $line[0] ?>>
                                        </td>
                                        <td style="color: <?php echo $line[1] ?>;">
                                            <?php echo $line[0] ?>
                                        </td>
                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name=<?php echo $colorName ?> value=<?php echo $line[0] ?> checked>
                                        </td>
                                        <td style="color: <?php echo $line[1] ?>;">
                                            <?php echo $line[0] ?>
                                        </td>
                            <?php
                                }
                                array_push($color, $colorName);
                            }
                        }
                        fclose($file);
                            ?>
                                    </tr>
                    </table>
                    <input type="submit" value="Simpan" name="Simpan">
                </form>
                <form method="post" action="home.php">
                    <input type="submit" name="Kembali" value="Kembali">
                </form>
            </div>



        <?php
        // Check If form submitted, insert form data into table.
        if (isset($_POST['Simpan'])) {
            $newExcludedColors = array();

            foreach ($color as $value) {
                if (!isset($_POST["$value"])) {
                    // checkbox was not checked...do something
                    array_push($newExcludedColors, $value);
                }
            }
            if (count($newExcludedColors) == 8) {
                $newExcludedColors = $excludedColors;

                echo "<script>
        var myVar;
        myFunction();
        
        function myFunction() {
          myVar = setTimeout(alertFunc, 1000);
        }
        
        function alertFunc() {
            alert('Sisakan Setidaknya Satu Warna. Setting Gagal Diperbarui!');
            window.location = './profile.php';
        }
        </script>";
            } else {
                $excludedColorsImplode = implode(",", $newExcludedColors);
                $model->setExcludedColors($_SESSION["username"], $excludedColorsImplode);
                // Show message when settings
                echo "<script>
        var myVar;
        myFunction();
        
        function myFunction() {
          myVar = setTimeout(alertFunc, 1000);
        }
        
        function alertFunc() {
            alert('Setting Berhasil Diperbarui!');
            window.location = './profile.php';
        }
        </script>";
            }
        }
    }

        ?>
        </body>



</html>