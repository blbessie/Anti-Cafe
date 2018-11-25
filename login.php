<?php
$servername = "localhost";
$username = "root";
$passward = "";
$dbname = "myDB";
$tablename = "WebsiteUsers";
//Create connection
$connection = new mysqli($servername, $username, $passward, $dbname);

$username   = mysqli_real_escape_string ($connection,$_POST['username']);
$password   = mysqli_real_escape_string ($connection,$_POST['password']);

$query = "SELECT * FROM WebsiteUsers WHERE username='$username' and pass='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){
    echo "condragulatios";

    }else{

        $fmsg = "Invalid Login Credentials.";
        echo $fmsg;
}

?>
