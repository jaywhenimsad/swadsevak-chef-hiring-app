<?php
    $server = "localhost";
    $host = "root";
    $password = "";
    $database = "new";

    $conn = mysqli_connect($server, $host, $password, $database);

    if(!$conn){
        die ("Connection Failed: ".mysqli_connect_error());
    }   
    
    
