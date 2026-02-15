<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database_name = "dodo_travel";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sqlUse = "USE $database_name";
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    