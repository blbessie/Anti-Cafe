<?php
$servername = "localhost";
$username = "root";
$passward = "";
$dbname = "myDB";
$tablename = "WebsiteUsers";

//Create connection
$connection = new mysqli($servername, $username, $passward, $dbname);

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username   = mysqli_real_escape_string ($connection,$_POST['username']);
    $amount   = mysqli_real_escape_string ($connection,$_POST['amount']);
    $button   = mysqli_real_escape_string ($connection,$_POST['button']);
    
       
    $query = "SELECT userID,points,lname,fname,username FROM WebsiteUsers where username='$username'";
    $result = mysqli_query($connection,$query);
    $numResults = mysqli_num_rows($result);

    if($numResults==1){
            
        $row = mysqli_fetch_assoc($result);
        $user_id =  $row['userID'];
        $user_points =  $row['points'];
        $lname =  $row['lname'];
        $fname =  $row['fname'];

            if(($button == "add") and is_numeric($amount)) {
            $user_points += $amount;
            echo $user_points;
            $sql = "UPDATE WebsiteUsers SET points='$user_points' WHERE userID='$user_id'";
            }
            
            if(($button == "remove") and is_numeric($amount)) {
                if ($amount<0) $amount= -$amount;
                $user_points -= $amount;
                if ($user_points < 0){
                    echo "PointLimit";
                    exit;
                }
                else{
                    $sql = "UPDATE WebsiteUsers SET points='$user_points' WHERE userID='$user_id'";
                }
            }
                
            if($button == "delete") {
                $sql = "DELETE FROM WebsiteUsers WHERE userID='$user_id'";
            }
        

        if ($connection->query($sql) === TRUE) {

            echo "<tr>";
            echo "<td>" . $button . "</td>";
            echo "<td>" . $username . "</td>";
            echo "<td>" . $lname . "</td>";
            echo "<td>" . $fname . "</td>";
            echo "<td>" . $user_points . "</td>";
            echo "</tr>";

        } else {
            echo false;
            $connection->error; 
        }

    } else {
        echo false;
        $connection->error; 
        }
}   

    $connection->close(); 

?>
