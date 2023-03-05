<?php

require_once './DataBaseConnection.php';

$infonum = $_GET['info'];
if($infonum > 0)
{
    $sql = "SELECT ResName, ResPPU, ResDesc, ResImage FROM CSIS2440.Resources WHERE idResources = " . $infonum;
    
    echo"<table align = 'left' width='100%'><tr><th>Name</th><th>Price</th><th>Description</th></tr>";
    
    $result = $con->query($sql);
    
    //if there is an entry in the database matching that info number set variables to match what is returned in that sql query and print
    if(mysqli_num_rows($result) > 0)
    {
        list($infoname, $infoprice, $infodesc, $infoimage) = mysqli_fetch_row($result);
        
        echo "<tr>";
        echo "<td align=\"left\" width=\"250\">$infoname</td>";
        echo "<td align=\"left\"width=\"125px\">" .money_format('%(#8n', $infoprice) . "</td>";
        echo "<td align=\"center\">$infodesc</td>";
        echo" <td align\"left\"><img src='imgs\\$infoimage' height=\"160\" width =\"160\"></td>";
        echo "</tr>";
    }
    echo "</table>";
}