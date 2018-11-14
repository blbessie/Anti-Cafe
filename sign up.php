<?php
include('config.php');
if(isset($_POST['action']))
{          
    if($_POST['action']=="signup") {
        $username       = mysqli_real_escape_string($connection,$_POST['username']);
        $email      = mysqli_real_escape_string($connection,$_POST['email']);
        $password   = mysqli_real_escape_string($connection,$_POST['password']);
        $query = "SELECT email FROM users where email='".$email."'";
        $result = mysqli_query($connection,$query);
        $numResults = mysqli_num_rows($result);
    } 
    elseif($numResults>=1){
        $message = $email." Email already exist!!";
    } else {
            mysql_query("insert into users(username,email,password) values('".$username."','".$email."','".$password."')");
            $message = "Signup Sucessfully!!";
        }
}
 
?>
