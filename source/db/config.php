<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "delista";

    try {
        $conn = new mysqli($hostname, $username, $password, $database);
        // echo "database connected successfully";
    } catch (\Throwable $th) {
        echo "can't connect to the database";
    }
?>