<?php

    $servername = 'localhost';
    $username = 'root';
    $password = 'km_falcatan12';
    $dbname = 'webcraft';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

?>