<?php


function ConnectDB()
{
    $servername = "localhost";
    $username = "root";
    $passward = "";
    $dbname = "myDB";

    // Create connection
    $connection = new mysqli($servername, $username, $passward, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die ("Connection filed: " . $connection->connect_error);
    }

    return $connection;
}

function DisconnectDB($connection)
{
    $connection->close();
}
?>