<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "activity1";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn -> connect_error){
        die("Connection Failed: ". $conn->connect_error);
    }
?>