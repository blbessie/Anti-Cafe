<?php

    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();
    $table_name = "TableReservation";

    // create sql
    // $sql = "CREATE DATABASE myDB";
    // if ($connection->query($sql) === TRUE)
    // {
    //     echo "Database exist";
    // }
    // else 
    // {
        
    //     echo "Error creating database: " . $connection->error;
    // }

    //Create connection

    $val = $connection->query("SELECT '$table_name' FROM information_schema.tables WHERE table_schema = 'myDB' AND table_name = '$table_name';");
    if ($val !== FALSE)
    {
        echo "table exist <br>";
    }
    else 
    {
        $sql = "CREATE TABLE TableReservation (
            tablenum INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            reserver VARCHAR(30),
            maxpeople INT(4) NOT NULL,
            isreserved CHAR(1) NOT NULL,
            reg_date TIMESTAMP
        )";

        if ($connection->query($sql) === TRUE) {
            echo "Table created successfully";
        }
        else {
            echo "fail" . $connection->error;
        }
    }
    
    //InsertRecord($connection, $table_name, 2, F);

    $sql = "SELECT * FROM $table_name";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["tablenum"] . " " . $row["maxpeople"] . " " . $row["isreserved"] . " " . $row["reg_date"] . "<br>";
        }
    }
    else {
        echo "0 results";
    }

    DisconnectDB($connection);
?>