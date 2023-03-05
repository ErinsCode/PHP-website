<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once "DataBaseConnection.php"; //use to connect to database
//get form posts
$formOption = cleanFormInput($_POST['formOption']);
$serviceName = cleanFormInput($_POST['serviceName']);
$servicePrice = cleanFormInput($_POST['servicePrice']);
$imageurl = cleanFormInput($_POST['imageurl']);
$description = cleanFormInput($_POST['description']);
?>
<head>
    <meta charset="UTF-8">
    <title>Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class = "container mainContent">


        <?php
        //if user selected to search for service send search
        if ($formOption == "search") {

            echo "<h3 class='p-5'>Search Results</h3>";
            $search = "SELECT * FROM Services where serviceName like '%$serviceName%' "
                    . "Order By serviceName";
            $return = $conndb->query($search);

            if (!$return) {
                //use for testing, don't want user to see database schema
//                $message = "Whole query " . $search;
//                echo $message;
//                die('Invalid query: ' . mysqli_error($con));

                print("<p>Error while searching/p>");
            } else {
                while ($result = $return->fetch_assoc()) {
                    echo getResult($result);
                }
            }
        }
//create entry
        else if ($formOption == "create") {

            $search = "SELECT * FROM Services WHERE serviceName = '$serviceName' ";
            $return = $conndb->query($search);

            $count = $return->num_rows;

            if (!$count == 1) {



                if ($serviceName != "" && $servicePrice != "" && $imageurl != "") {
                    $insert = "INSERT INTO `CompanyDB`.`Services` (`serviceName`, `servicePrice`, `description`, `image`)"
                            . "VALUES('$serviceName', '$servicePrice', '$description', '$imageurl')";

                    $success = $conndb->query($insert);

                    if ($success == FALSE) {
                        //use for testing, don't want user to see database schema
//                $message = "Whole query " . $success;
//                echo $message;
//                die('Invalid query: ' . mysqli_error($conndb));
                        echo "<h3>We were unable to add your service</h3>";

                        //put code to check that input is right length
                    } else {
                        echo "<h3 class='p-5'>New Service Added</h3>";
                        $newItem = array("serviceName" => $serviceName, "servicePrice" => $servicePrice, "description" => $description, "image" => $imageurl);
                        echo getResult($newItem);
                    }
                } else {
                    echo"<ul>You must include the following to create a new service:"
                    . "<li>Service Name</li>"
                    . "<li>Service Price</li>"
                    . "<li>Image Url</li></ul>";
                }
            } else {
                echo "<h3>That service already exists</h3>";
                
            }
        }
//update entry 
        else if ($formOption == "update") {

            $priceSuccess;
            $descSuccess;

            if ($servicePrice != "") {
                $updatePrice = "UPDATE `CompanyDB`.`Services` SET `servicePrice` ='"
                        . $servicePrice . "' WHERE (`serviceName` = '" . $serviceName . "')";
                $priceSuccess = $conndb->query($updatePrice);

                if ($priceSuccess == FALSE) {
                    //error if query did not run
                    //for testing don't show db schema to user
//                    $failmess = "Whole query " . $updatePrice . "<br>";
//                    echo $failmess;
//                    print('Invalid query: ' . mysqli_error($conndb) . "<br>");
                    echo "Unable to update price";
                }
            }
            if ($description != "") {

                $desUpdate = "UPDATE `CompanyDB`.`Services` SET `description` = '"
                        . $description . "' WHERE (`serviceName` = '" . $serviceName . "')";
                $descSuccess = $conndb->query($desUpdate);

                if ($descSuccess == FALSE) {
//                    //error if query did not run
//                    $failmess = "Whole query " . $desUpdate . "<br>";
//                    echo $failmess;
//                    print('Invalid query: ' . mysqli_error($conndb) . "<br>");
                    echo "Unable to update description";
                }
            }

            if ($descSuccess || $priceSuccess) {

                echo "<h3 class='p-5'>Service Updated</h3>";
                $string = " <div class='container box-border'>"
                        . " <div class='row text-start'>"
                        . "  <div class = 'col-md-4'><h3>Information Updated</h3></div>"
                        . " <div class='col-md-8'><div class='row'><div class = 'col-md-4'><h5>" . $serviceName . "</h5></div>";

                if ($servicePrice != "") {
                    $string .= "   <div class = 'col-md-2'><h5>$" . $servicePrice . "</h5></div></div>";
                }

                $string .= "   <div class = 'col-md-12'><p>" . $description . "</p></div>"
                        . " </div> </div> </div>";

                echo $string;
            } else {
                echo"<p>Price and description not changed in form</p>";
            }
        } else {
            echo"<h3>There was a problem processing your request";
        }

        //print out service for user
        function getResult($result) {

            $string = "";
            if ($result == null) {
                $string = "<p>No Results Found</p>";
            } else {
                $string = " <div class='container box-border'>"
                        . " <div class='row text-start'>"
                        . "  <div class = 'col-md-4'><img class='w-100 h-100 productResultImg' src='" . $result['image'] . "'></div>"
                        . " <div class='col-md-8'><div class='row'><div class = 'col-md-4'><h5>" . $result['serviceName'] . "</h5></div>"
                        . "   <div class = 'col-md-2'><h5>$" . $result['servicePrice'] . "</h5></div></div>"
                        . "   <div class = 'col-md-12'><p>" . $result['description'] . "</p></div>"
                        . " </div> </div> </div>";
            }
            return $string;
        }

        //function to strip out sql injection and xss attacks.
        function cleanFormInput($str) {
            $str = htmlentities($str);
            $str = stripslashes($str);
            $str = strip_tags($str);
            return $str;
        }
        ?>
    </div>
</body>
</html>
