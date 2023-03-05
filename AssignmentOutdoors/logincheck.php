<?php

session_start();
unset($_SESSION['badPass']);

//connect to server and the database
require_once "DataBaseConnection.php";

//stop mysql injection attack
$myusername = cleanInputValue($conndb, $_POST['uname']);
$mypassword = cleanInputValue($conndb, $_POST['password']);

//hash password
$Hashed = hash("ripemd128", $mypassword);

$sql = "SELECT * FROM CompanyDB.Clients WHERE email = '$myusername' AND thepassword = '$Hashed'";
$result = $conndb->query($sql);

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
    $_SESSION['first'] = $row['fname'];  //no session info passed back to user's computer.  Just saved on server.
    $_SESSION['last'] = $row['lname'];
    $_SESSION['loggedIn'] = true;
    
    //take the username and redirect to the cart
    $conndb->close();
    header("Location:cart.php"); //can't have anything echo out before header or it won't work.  Redirects them to dashboard page
}
else
{
  
    $conndb->close();
    header("Location:login.php");  //can't have anything echo out before header or it won't work.  Redirects them to login page
    $_SESSION['badPass']++;
}





