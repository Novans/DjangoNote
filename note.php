<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open: </title>
</head>
<body>
<?php echo $_POST["judul"]; ?>
    <form action="../builder.php" method="post">
        <textarea name="judul" id="judul" cols="30" rows="2"></textarea>
        <br>
        <textarea name="isi" id="isi" cols="30" rows="10"></textarea>
        <input type="submit" value="Home">
    </form>
</body>
</html>