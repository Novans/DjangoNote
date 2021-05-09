<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Open: '. end($_SESSION['note'])[1]. '</title>
</head>
<body>

<?php
include_once('../uts/control.php');
session_start();

$model = new control();

$excludedColors = array();
$getExcludedColor = $model->getExcludedColors($_SESSION['username']);
foreach ($getExcludedColor as $value) {
    array_push($excludedColors, $value);
}
$colorsName = array();
foreach ($excludedColors as $values) {
    if (str_contains($values, 'Muda')) {
        $values = str_replace('Muda', ' Muda', $values);
    }
    array_push($colorsName, $values);
}

randomIndex();

function randomIndex()
{
    $files = file('color.csv');
    $len = count($files) - 1;
    $randomIndex = rand(0, $len);
    $csv = $files[$randomIndex];
    $data = str_getcsv($csv);
    global $colorsName;
    if (!str_contains($data[0], 'Warna')) {
        if (in_array($data[0], $colorsName)) {
            randomIndex();
        } else {

?>

            <body style='background-color:<?php echo $data[1] ?>'>
    <?php
        }
    } else {
        randomIndex();
    };
};


    ?>

    <h2>'. end($_SESSION['note'])[1]. '</h2>
    <p>'. end($_SESSION['note'])[2]. '</p>
    <form action='../home.php' method='post'>
        <input type='submit' value='Home'>
    </form>
</body>
</html>