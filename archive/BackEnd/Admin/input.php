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

$query = "SELECT userID,points,lname,fname,username FROM WebsiteUsers where username='$username'";
$result = mysqli_query($connection,$query);
$numResults = mysqli_num_rows($result);

if($numResults>=1){
$row = mysqli_fetch_assoc($result);
$lname =  $row['lname'];
$fname =  $row['fname'];
$points =  $row['points'];
 
        echo "<tr>";
        echo "<td>" . $username . "</td>";
        echo "<td>" . $lname . "</td>";
        echo "<td>" . $fname . "</td>";
        echo "<td>" . $points . "</td>";
        echo "</tr>";

} else {

        echo false;

}

}

$connection->close(); 

?>
