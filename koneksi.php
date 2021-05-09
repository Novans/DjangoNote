<?php


class koneksi
{

    public $mysqli;

    public function __construct()
    {
        $this->mysqli =  mysqli_connect("localhost", "root", "hamburger123", "filkomnote");
    }
}
