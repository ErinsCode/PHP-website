<?php


//connect to the database
$host = "localhost";
$user = "root";
$password = "DBAdmin";
$dbname = "CSIS2440";
$con = new mysqli($host, $user,$password, $dbname) or die ('Could not connect to the databse server. ' . mysqli_connect_error());


if($con->connect_error == false)
{
    echo "<h2>We Connnected</h2>";
    
}

else
{
    echo $con->connect_error;
}

print_r($con);