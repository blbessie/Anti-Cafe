<?php
$servername = "localhost";
$username = "root";
$passward = "";
$dbname = "myDB";
$tablename = "WebsiteUsers";
//Create connection
$connection = new mysqli($servername, $username, $passward, $dbname);


        $fname       = mysqli_real_escape_string ($connection,$_POST['fname']);
        $lname       = mysqli_real_escape_string ($connection,$_POST['lname']);
        $email       = mysqli_real_escape_string ($connection,$_POST['email']);
        $username   = mysqli_real_escape_string ($connection,$_POST['username']);
        $password   = mysqli_real_escape_string ($connection,$_POST['password']);
        $points     = "O";
       
       
        $query = "SELECT email FROM WebsiteUsers where email='".$email."'";
        $result = mysqli_query($connection,$query);
        $numResults = mysqli_num_rows($result);

        if($numResults>=1){
            $message = "E-Mail already exist!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script> location.href='index.html'; </script>";
        } else {
            $sql = "INSERT INTO WebsiteUsers (fname, lname, email, userName, pass, points) VALUES ('$fname', '$lname', '$email','$username', '$password', '$points')";

            if ($connection->query($sql) === TRUE) {
                $message = "Sign Up Successfully!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script> location.href='index.html'; </script>";
            } else {
                echo "fail" . $connection->error; 
            }
        }
 
$connection->close();
?>
