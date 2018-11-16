<?php
    $servername = "localhost";
    $username = "root";
    $passward = "";
    $dbname = "myDB";

    // Create connection
    $connection = new mysqli($servername, $username, $passward);

    // Check connection
    if ($connection->connect_error) {
        die ("Connection filed: " . $connection->connect_error);
    }

    // create sql
    $sql = "CREATE DATABASE myDB";
    if ($connection->query($sql) === TRUE)
    {
        echo "Database exist";
    }
    else 
    {
        
        echo "Error creating database: " . $connection->error;
    }

    //Create connection
    $connection = new mysqli($servername, $username, $passward, $dbname);

    $sql = "CREATE TABLE TableReservation (
        tablenum INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        reserver VARCHAR(30),
        maxpeople INT(4) NOT NULL,
        isreserved CHAR(4) NOT NULL,
        reg_date TIMESTAMP
    )";

    if ($connection->query($sql) === TRUE) {
        echo "Table created successfully";
    }
    else {
        echo "fail" . $connection->error;
    }
    $connection->close();
?>