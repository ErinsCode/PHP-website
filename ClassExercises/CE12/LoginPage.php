<?php
session_start(); //need this to use a session on page
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>


        <?php
        include "Header.php";

        print <<<HTML
         <div>
            <form name="form1" method="post" action="LoginCheck.php" >
                <table align = "center" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

                    <tr>
                        <td colspan="3"><strong>Member Login </strong></td>

                    </tr>
                    <tr>
                        <td width="78">Username</td>
                        <td width="6">:</td>
                        <td width="294"><input name="myusername" type="text" id="myusername" class="error"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input name="mypassword" type="password" id="mypassword">
HTML;

        if (isset($_SESSION['badPass'])) {
            echo "<br> Username or password do not match";
        }

        print <<<HTML
        </td>
        </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Login" onclick="return loginfilled();"></td>
                    </tr>

                    <tr>
                        <td>

                            <a href="NewAccount.php">Create an Account</a>

                        </td>
                    </tr>
                </table>
            </form>
</div>
        
HTML;
        include "Footer.php";
        

  
