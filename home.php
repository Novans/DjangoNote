<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION["username"]) and empty($_SESSION["password"])) {
    echo "Maaf, anda belum login";
} else {

?>

    <head>
        <title>Home Tab</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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

            .topnav {
                background-color: #333;
                overflow: hidden;
            }

            /* Style the links inside the navigation bar */
            .topnav a {
                font-family: sans-serif;
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
        </style>
    </head>

    <body>
        <div class="topnav">
            <a class="active" href="home.php">Home</a>
            <a href="add.php"> Add Note</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
        <nav class="nav nav-pills justify-content-end">
            <li class="nav-item">
                <form action="add.php" method="post">
                    <input class="btn btn-primary" type="submit" value="Tambah">
                </form>
            </li>
        </nav>

        <div class="card-columns">
            <?php
            error_reporting(0);
            session_start();

            include("control.php");
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

                        error_reporting(0);
                        session_start();

                        $model = new control();

                        $_SESSION["noteData"] = $model->getNoteData($_SESSION["username"]);

                        if (file_exists('note.php')) {
                            unlink('note.php');
                        }

                        if (isset($_SESSION["noteData"])) {
                            for ($i = 0; $i < count($_SESSION["noteData"]); $i++) {
                                if (!is_null($_SESSION["noteData"])) {
                                    echo "

                            <div class=\"card\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">";

                                    echo $_SESSION["noteData"][$i][0];

                                    echo "</h5>
                                    
                                    <nav class=\"nav nav-pil\">
                                        <li class=\"nav-item\" style=\"margin-right: 2%;\">
                                            <form action=\"read.php\">
                                                <input class=\"btn btn-primary\" type=\"submit\" value=\"Lihat\">
                                                <input type=\"hidden\" id=\"indexNote\" name=\"indexNote\" value=\"";
                                    echo $i;
                                    echo "\" >
                                            </form>
                                        </li>
                                        <li class=\"nav-item\">
                                            <form action=\"delete.php\" method=\"post\">
                                                <input class=\"btn btn-primary\" type=\"submit\" value=\"Hapus\">
                                                <input type=\"hidden\" id=\"indexNote\" name=\"indexNote\" value=\"";
                                    echo $i;
                                    echo "\" >
                                            </form>
                                        </li>
                                    </nav>
                                </div>
                            </div>
                                
                        ";
                                }
                            }
                        }
                    }
                }
            }

            randomIndex();
            ?>
        </div>

    </body>

<?php
}
?>

</html>