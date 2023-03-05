<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Services</title>
     <?php
   
     include 'header.php';

   
    //info posted from the product info form
    $user = htmlentities($_POST['fname']);
    $serviceArea = htmlentities($_POST['state']);
    $serviceArea = strtoupper($serviceArea); // make sure to capitalize it so it can match with the servicearea.txt data
    $service = htmlentities($_POST['service']);

    //make an array of images to match with the selections
    $images = array("Custom Trip Planning for Corporate Retreat" => "img/corp1.jpg",
        "Custom Trip Planning for Couple" => "img/couple1.jpg",
        "Custom Trip Planning for Family" => "img/family1.jpg",
        "Backpacking" => "img/hiking1.jpg",
        "E-Guides" => "img/eguides1.jpg");

    //read what service areas are available from the servicearea.txt file
    //and put them in an array.  We will compare the array to the customer's choice
    //to see if that service area is available.
    $availServiceAreas = explode(",", file_get_contents("text/servicearea.txt"));
    ?>
<div class="pageWrapper">
    <div class="container mainContent">
        <?php
//print the user name 
        print("<h1>Welcome $user!</h1>");

//check if service area customer entered is available by reading from the $availServiceAreas array.  
//If it is not alert the user.  If it is describe the service and display photo
        $areaAvailable = false;
        foreach ($availServiceAreas as $state) {
            if ($state == $serviceArea) {
                $areaAvailable = true;
                break;
            }
        }

        if (!$areaAvailable) {
            print("<h2 class ='text-danger'>Sorry, we do not currently have services in that area.</h2>");
        } else {

            print("<img id = 'serviceimg' src='$images[$service]' alt='service picture'>");

             print("<h3>$service </br> $serviceArea</h3>");
             
            //get the correct description for the service selected by the user from the productinfo.txt file and 
            //display it on screen.  Each description starts with "{[service name]- " and ends with }
            //we are going to modify the description so it gets rid of the curly braces and the service name.
            $serviceText = explode("}", file_get_contents("text/productinfo.txt"));  //create an array of descriptions

            $strToSearch = "{" .$service . "- "; //will use to match service with description
                     
            //if the service string matches with the beginning of an array element it is the correct service.
            //fix the descrition so it no longer includes the service name, and print the description.
            //If no description is found print an error.
            
            $foundService = false;
            foreach ($serviceText as $description) { 
                $description = trim($description, "\n\r");
                $productName = substr($description, 0 , strlen($strToSearch));
                if($productName == $strToSearch)
                {
                   $finalDescription =  str_replace($strToSearch, "", $description);
                    print("<p>$finalDescription</p>");
                    $foundService = true;
                }
                
            }
             
                if ($foundService == false) {
                    print("<p class = 'text-danger'>We don't have a description for that service</p>");
                }
            
        }

        echo "</div>";
        
        include 'NavBar.php';
            ?>

    </div>

</body>
</html>
