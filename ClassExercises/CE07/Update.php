<?php

$update = "UPDATE `CSIS2440`.`Planets` Set `Active` = 'Y'";
if ($desc != "A short description of the planet") {
    $update .= ", `Desc` = '$desc'";
}

$update .= "WHERE (`PlanetName` = '" . $name . "')"; //add the where clause
$success = $con->query($update);
if ($success == FALSE) {
    //error if query did not run
    $failmess = "Whole query " . $update . "<br>";
    echo $failmess;
    print('Invalid query: ' . mysqli_error($con) . "<br>");
} else {
    //let user know it worked
    echo $name . " was given a space station<br>";
}
