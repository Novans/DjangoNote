<?php

// include('koneksiMVC.php');
session_start();
session_destroy();
// $database = new koneksiMVC();
session_start();

$_SESSION["count"] = 0;
$_SESSION["note"]=array(array());
header("location: home.php");