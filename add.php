<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

?>

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
                            margin-top: 1.8%;
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

                        .topnav {
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

                        @media screen and (max-width: 800px) {
                            .box {
                                width: 250px;
                                padding: 30px;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background: whitesmoke;
                                text-align: center;
                            }

                            .box input[type="submit"] {
                                border: 0;
                                background: none;
                                display: block;
                                margin: 10px auto;
                                text-align: center;
                                border: 1px solid #2ecc71;
                                padding: 12px 35px;
                                outline: none;
                                color: black;
                                border-radius: 22px;
                                transition: 0.25s;
                                cursor: pointer;
                            }

                            .box textarea {
                                background-color: whitesmoke;
                                border: 1px solid lightsalmon;
                                width: 200px;
                            }

                            .box input[type="text"] {
                                border-radius: 0;
                                background: none;
                                display: block;
                                margin: 1px auto;
                                text-align: center;
                                border: 1x solid lightsalmon;
                                padding: 10px 30px;
                                width: 125px;
                                outline: none;
                                border-radius: 20px;
                                transition: 0.25s;
                            }

                        }

                        @media screen and (max-width: 600px) {
                            .box {
                                width: 200px;
                                padding: 30px;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                background: whitesmoke;
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

                            .box textarea {
                                background-color: whitesmoke;
                                border: 1px solid lightsalmon;
                                width: 150px;
                            }

                            .box input[type="text"] {
                                border-radius: 0;
                                background: none;
                                display: block;
                                margin: 10px auto;
                                text-align: center;
                                border: 1x solid lightsalmon;
                                padding: 10px 30px;
                                width: 100px;
                                outline: none;
                                border-radius: 20px;
                                transition: 0.25s;
                            }

                        }
                    </style>
                </head>

                <body>



                    <body style="background-color:<?php echo $data[1] ?>">
            <?php
            }
        } else {
            randomIndex();
        };
        // now do whatever you want with $data, which is one random row of your CSV
    };


            ?>

            <div class="topnav">
                <a class="active" href="index.php">Home</a>
                <a href="add.php"> Add Note</a>
                <a href="profile.php">Profile</a>
                <a>Logout</a>
            </div>

            <div class="box">
                <form action="builder.php" method="post">
                    <h1>Judul Notes</h1>
                    <input type="text" name="judul" id="judul" required>
                    <h1>Isi</h1>
                    <textarea name="isi" id="isi" cols="30" rows="10"></textarea>

                    <input type="submit" value="Simpan">
                </form>
                <form method="post" action="home.php">
                    <input type="submit" name="Kembali" value="Kembali">
                </form>
            </div>
                    </body>

                <?php
            }
                ?>

</html>