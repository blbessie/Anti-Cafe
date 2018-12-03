<?php
$servername = "localhost";
$username = "root";
$passward = "";
$dbname = "myDB";
$tablename = "WebsiteUsers";
//Create connection
$connection = new mysqli($servername, $username, $passward, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

$username   = mysqli_real_escape_string ($connection,$_POST['username']);
$password   = mysqli_real_escape_string ($connection,$_POST['password']);

$query = "SELECT * FROM WebsiteUsers WHERE username='$username' and pass='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){

    if($username == "admin"){

    echo "<script> location.href='/AdminPage/admin.html'; </script>";
        exit;
    }else{  

        echo "<script> location.href='/Reservation/main.php'; </script>";
        exit;
    }

    }else{

        $message = "Username and/or Password incorrect. Try again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script> location.href='index.html'; </script>";
    }
}

?>
