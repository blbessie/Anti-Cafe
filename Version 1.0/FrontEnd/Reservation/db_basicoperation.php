<?php

function InsertRecord($conn, $table_name, $maxpeople, $isreserved){
    //insert record

    $sql = "INSERT INTO " . $table_name . "(maxpeople, isreserved) 
    VALUES ('$maxpeople', '$isreserved')";

    if ($conn->query($sql) === TRUE) 
    {
        echo "New record created successfully <br>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

function DeleteAllRecord($conn, $table_name) {
    $sql = "DELETE FROM '$table_name'";
    return $conn->query($sql);
}

function DeleteRecordAt($conn, $table_name, $index) {
    $sql = "DELETE FROM '$table_name' WHERE tablenum = '$index'";
    return $conn->query($sql);
}


?>