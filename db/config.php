<?php

$host = "localhost";
$user = "root";
$pass = "people@8624";
$db_name = "gmh";

$dbc = mysqli_connect($host,$user,$pass,$db_name)
    or die("Error in connection: " .mysqli_connect_error());
?>