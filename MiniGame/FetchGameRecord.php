<?php
    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();
    $table_name = "GameRecord";

    $sql="Select * From `{$table_name}` Order by (score) DESC;";
    $result = $connection->query($sql);

    $rows = array();
    // while($row = mysqli_fetch_array($result))
    // {
    //     $rows = $row;
    // }
    $index = 1;
    while($row = $result->fetch_assoc()) {
        if ($index != 6){
            echo "<p style='color: white'> No." .$index. ": " .$row["username"]. "     " . $row["score"]. "    " . $row["playtime"]. "</p>";
            $index = $index + 1;
        }
    }
    //echo $rows[0];

    DisconnectDB($connection);
?>