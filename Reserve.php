<!DOCTYPE html>
<?php
    //start the session
    session_start();
?>

<html>
<head>
<script type="text/javascript">
    function myFunc(){
        window.location.replace("main.php");
    }
</script>
</head>
<body>
<?php
    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();
    $table_name = "TableReservation";
    $reserv_table = "Reservations";

    $val = $connection->query("SELECT '$reserv_table' FROM information_schema.tables WHERE table_schema = 'myDB' AND table_name = '$reserv_table';");
    if ($val !== FALSE)
    {
        echo "table exist <br>";
    }
    else 
    {
        echo "No such table exist <br>";
    }
    
    //insert record
    $user = $_SESSION["username"];
    $seat = $_POST["seat"];
    $num = $_POST["number"];
    $duration = $_POST["duration"];
    $time = $_POST["time"];

    $sql = "INSERT INTO " . $reserv_table . "(user, tableNum, numofPeople, duration, time) 
    VALUES ('$user', '$seat', '$num', '$duration', '$time')";

    if ($connection->query($sql) === TRUE) 
    {
        echo "New record created successfully <br>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    //update info for the tables
    // $sql = "UPDATE $table_name
    // SET reserver = $user, isreserved = 'F'
    // WHERE tablenum = $seat;"

    // show database
    $sql = "SELECT * FROM Reservations";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo $row["user"] . " " . $row["tableNum"] . " " . $row["numofPeople"] . " " . $row["duration"] . " " . $row["arriveTime"] . " " . $row["reg_date"] . "<br>";
        }
    }
    else {
        echo "0 results <br>";
    }

    DisconnectDB($connection);
?>

<body>

Reserve sucessfully! <br>
You reserved for <?php echo $_POST["number"]; ?> people for <?php echo $_POST["duration"]; ?> hours at Table <?php echo $_POST["seat"]?>. <br>
Please arrive before <?php echo $_POST["time"]; ?> <br>
<form>
    <input type="button" value="return" onclick="myFunc()">
</form>
<?php
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

</body>
</html>