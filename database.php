<?php
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "cruzcrisx";
    $dbName = "tienda";
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if(!$conn){
        die("Ocurrió un error");
    }
?>