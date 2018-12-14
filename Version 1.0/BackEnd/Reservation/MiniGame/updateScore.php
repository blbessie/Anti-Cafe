<?php
    include 'db_connection.php';
    include 'db_basicoperation.php';

    $connection = ConnectDB();
    $table_name = "GameRecord";

    // first try to find if the user exist in the table
    $sql = "SELECT * FROM `{$table_name}`";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
        echo $connection->error;
    }

    // update if at least one result is there, else insert
    // first check if the table is empty
    if ($result->num_rows > 0){
        // if not empty, select the entry with specific user name
        $sql = "SELECT * FROM `{$table_name}` WHERE username='{$_POST['Username']}'";
        $result = $connection->query($sql);

        if ($result == FALSE)
        {
            echo $connection->error;
        }

        // if username exist and the new score is higher than the current record we update
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                if ($_POST['Score'] > $row['score']){
                    $sql = "UPDATE `{$table_name}`
                        SET score = '{$_POST['Score']}', playtime = '{$_POST['Time']}'
                        WHERE username = '{$_POST['Username']}'";
                        
                    if($connection->query($sql)==TRUE){echo "update" .$_POST['Score']."<br>";}
                    else{echo $connection->error;}
                }
            }
        }
        // else we insert record to the database
        else {
            $sql = "INSERT INTO `{$table_name}` (username, score, playtime) 
                VALUES ('{$_POST['Username']}', `{$_POST['Score']}`, `{$_POST['Time']}`)";
            $outcome = $connection->query($sql);
        }    
    }
    // insert record to the empty database
    else{
        $sql = "INSERT INTO `{$table_name}` (username, score, playtime) 
                VALUES ('{$_POST['Username']}', '`{$_POST['Score']}`', '`{$_POST['Time']}`')";
        $outcome = $connection->query($sql);
        if ($outcome == FALSE)
        {
            echo $connection->error;
        }
    }
    
    $sql = "SELECT * FROM `{$table_name}` WHERE username='{$_POST['Username']}'";
        $result = $connection->query($sql);
        if ($result == FALSE)
        {
            echo $connection->error;
        }

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row["username"] . " " . $row["score"] . " " . $row["playtime"];
            }
        }

   
    
    DisconnectDB($connection);
?>