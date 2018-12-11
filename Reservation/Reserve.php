<?php
    //start the session
    session_start();

    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();
    $table_name = "TimeTable";
    $reserv_table = "Reservations";

    $val = $connection->query("SELECT '$reserv_table' FROM information_schema.tables WHERE table_schema = 'myDB' AND table_name = '$reserv_table';");
    if ($val === FALSE)
    {
        echo "No such table exist <br>";
    }
    
    //insert record
    $user = $_SESSION["username"];
    $seat = $_POST["seat"];
    $num = $_POST["number"];
    $duration = $_POST["duration"];
    $time = $_POST['time'];

    $sql = "INSERT INTO " . $reserv_table . "(user, tableNum, numofPeople, duration, time, status) 
    VALUES ('$user', '$seat', '$num', '$duration', '$time', 'active')";

    if ($connection->query($sql) !== TRUE) 
    {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $sql = "SELECT i
    FROM $table_name WHERE timeslot = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $_POST['time']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($index);
    $stmt->fetch();
    $stmt->close();

    $fut = $index+$duration-1;

    //update info for the tables
    if ($seat === '1'){
        for ($i = $index; $i<=$fut; $i++){
            $sql = "UPDATE `{$table_name}`
            SET table1 = 'T'
            WHERE i = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $stmt->close();
        }
    }
    else if ($seat === '2'){
        for ($i = $index; $i<=$fut; $i++){
            $sql = "UPDATE `{$table_name}`
            SET table2 = 'T'
            WHERE i = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo "
        Reserve sucessfully!
        You reserved for " .$_POST["number"]. " people for " .$_POST["duration"]. " hours at Table " .$_POST["seat"]. "
        Please arrive before " .$_POST["time"]. "
    ";

    DisconnectDB($connection);
?>