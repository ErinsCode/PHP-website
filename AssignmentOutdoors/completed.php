<!DOCTYPE html>
<?php
require_once "DataBaseConnection.php";

$fname = htmlentities($_POST['fname']);
$lname = htmlentities($_POST['lname']);
$phone = htmlentities($_POST['phone_1'] . "-" . $_POST['phone_2'] . "-" . $_POST['phone_3']);
$usename = htmlentities($_POST['email']);
$pword = htmlentities($_POST['pword']);
$address = htmlentities($_POST['address']);
$state = htmlentities($_POST['state']);
$zip = htmlentities($_POST['zip']);
$city = htmlentities($_POST['city']);
$birthday = htmlentities($_POST['year']) . '-' . htmlentities($_POST['month']) . '-' . htmlentities($_POST['day']);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Client Completed Page</title>
          <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        $insert = "Insert into Clients(`fname`, `lname`, `phone`, `address`, `city`, `state`, `zip`, "
                . "`birthday`, `email`, `thepassword`, `createdate`) "
                . "values ('" . $fname . "', '" . $lname . "', '" . $phone . "', '" . $address . "', '" . $city . "', '"
                . $state . "', '" . $zip . "', '" . $birthday . "', '" . $usename . "', '" . hash("ripemd128", $pword)
                . "', CURRENT_DATE())";
        //echo $insert;
        if ($conndb->query($insert) === TRUE) {
            $search = "select * from Clients where email ='" . $usename .  "'";
            //$message = "Whole query ".$search;
            //echo $message;
            $return = $conndb->query($search);
            //print_r($return);

            echo "<table><tr><th>Firstname</th><th>Lastname</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th></tr>";
            while ($row = $return->fetch_assoc()) {
                echo "<tr><td> " . $row['fname'] . "</td>";
                echo "<td> " . $row['lname'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td> " . $row['city'] . "</td>";
                echo "<td> " . $row['state'] . "</td>";
                echo "<td> " . $row['zip'] . "</td>";
                echo "<td> " . $row['phone'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Error updating record: " . $conndb->error;
        }
        $conndb->close();
        ?>
    </body>
</html>
