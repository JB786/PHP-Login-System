<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "phpform";

$connect = mysqli_connect($hostname, $username, $password, $database);

if(!$connect){
    die("Connection Failed!!".mysqli_connect_error());
}
