<?php

session_start();
unset($_SESSION['badPass']);


$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];


//connect to server and the database
require_once "DataBaseConnection.php";

//stop mysql injection attack
$myusername = mysql_fix_string($con, $myusername);
$mypassword = mysql_fix_string($con, $mypassword);

//hash password
$Hashed = hash("ripemd128", $mypassword);


$sql = "SELECT * FROM CSIS2440.Captains where Email = '$myusername' AND ThePass = '$Hashed' ";
$result = $con->query($sql);

if(!$result)
{
    $message = "Whole query" . $sql;
    echo $message;
    die('Invalid query: ' . mysqli_error());
}

//count how many rows in the table have that username and password to see if there is a user

$count = $result->num_rows;

if($count == 1)
{
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $myusername ; //session keys made up, just use consistently throughout site
    $_SESSION['password'] = $mypassword;  //no session info passed back to user's computer.  Just saved on server.
    $_SESSION['Captain'] = $row['CaptainName'];
    $_SESSION['Command'] = $row['Command'];
    $_SESSION['Combat'] = $row['Combat'];
    $_SESSION['Commerce'] = $row['Commerce'];
    $_SESSION['Cunning'] = $row['Cunning'];
    
    //take the username and password and redirect to "file login_success.php"
    header("Location:Dashboard.php"); //can't have anything echo out before header or it won't work.  Redirects them to dashboard page
}
else
{
    
    header("Location:LoginPage.php");  //can't have anything echo out before header or it won't work.  Redirects them to login page
    $_SESSION['badPass']++;
}



/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

