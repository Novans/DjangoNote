<?php

// include('koneksiMVC.php');
session_start();
session_destroy();

header("location: login.php");