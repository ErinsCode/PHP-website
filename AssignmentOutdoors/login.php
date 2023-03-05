<?php
session_start(); //need this to use a session on page
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <?php
        include "header.php";
        echo "<div class=\"pageWrapper\">";
        echo "<div id=\"loginDiv\">";
        print <<< HTML
        
       
        <form id= "loginForm" name="loginForm" method="post" action="logincheck.php">
        <h1>Login</h1>   
        <br>
        <label for="uname">User Name:</label>
        <input type="text" id="uname" name="uname"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Submit">
        <br>
        <br>
        <a href="clientform.php">Create New Login</a>
        </form>
        
       
HTML;
        
        //if the password is incorrect tell the user
        if (isset($_SESSION['badPass'])) {
            echo "<br> Username or password do not match";

            
        }

        echo "</div>";
        include "NavBar.php";
        echo "</div>";
        ?>
    </body>
</html>
