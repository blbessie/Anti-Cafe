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

$response = array();

$query = "SELECT * FROM WebsiteUsers WHERE userName='$username' and pass='$password'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

if ($count == 1){

    if($username == "admin"){
        $response['status'] = 'success';
        $response['message'] = 'admin';
        echo json_encode($response);
        exit;

    }else{  
        $response['status'] = 'success';
        $response['message'] = 'user';
        echo json_encode($response);
        exit;
    }

} else{
        $response['status'] = 'error';
        $response['message'] = 'Username and/or Password incorrect. Try again.';
        echo json_encode($response);
}

?>
