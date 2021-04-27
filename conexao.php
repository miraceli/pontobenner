<?php

$hostname = "localhost"; 
$user = "root";
$password = "";
$database = "ambiental";
$port = "8080";
$conexao = mysqli_connect($hostname, $user, $password, $database, $port);

if(!$conexao){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>