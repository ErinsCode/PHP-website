<?php
//write your insert statment

$insert = "INSERT INTO `CSIS2440`.`Planets` (`PlanetName`, `PosX`, `PosY`, `PosZ`, `Desc`, `Faction`)"
        . "Values ('$name', '$posx', '$posy', '$posz', '$desc', '$faction')";
//echo $insert
$success = $con->query($insert);

if ($success == FALSE) {
$failmess = "Whole query " . $insert . "<br>";
echo $failmess;
print('Invalid query: ' . mysqli_error($con) . "<br>");
//error if query did not run
} else {
    //let them know it was added
    echo $name . " was added<br>";
    
}
