<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

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

    <body>
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

        ?>
    </body>



</html>