<?php

if (file_exists("./koneksi.php")) {
    require "./koneksi.php";
} else {
    require "../koneksi.php";
}

class control
{
    private $database;
    protected $tablename = "user";

    public function __construct()
    {
        $this->database = new koneksi();
        $this->database = $this->database->mysqli;
    }

    public function getUsername($username)
    {
        return $this->database->query("(SELECT username FROM $this->tablename WHERE username='$username')");
    }

    public function checkUsername($username)
    {
        $result = $this->database->query("SELECT COUNT(*) FROM $this->tablename WHERE username='$username'")->fetch_row()[0];
        return $result;
    }

    public function getPassword($username)
    {
        return $this->database->query("(SELECT password FROM $this->tablename WHERE username='$username')");
    }

    public function setExcludedColors($username, $newExcludedColors)
    {
        $this->database->query("UPDATE $this->tablename SET excludedColors='$newExcludedColors' WHERE username='$username'") or die(mysqli_error($this->database));
    }

    public function getExcludedColors($username)
    {
        $result = $this->database->query("SELECT excludedColors FROM $this->tablename WHERE username='$username'")->fetch_row()[0];
        $excludedColors = explode(",", $result);
        return $excludedColors;
    }

    public function setData($username, $password)
    {
        $this->database->query("INSERT INTO $this->tablename (username, password) VALUES ('$username', '$password')") or die(mysqli_error($this->database));
    }
}
