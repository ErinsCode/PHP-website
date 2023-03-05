   <?php
    require_once "DataBaseConnection.php";
    
    //based on the info number provided display that service in a modal.  info will match the service's id in the database 
        $infonum = htmlentities($_GET['info']);

        $sql = "SELECT serviceName, servicePrice, image, description FROM CompanyDB.Services WHERE serviceId =" . $infonum;

        $info = $conndb->query($sql);

        //if it found the service in the database send the data returned into specified variables
        if (mysqli_num_rows($info) > 0) {
            list($infoname, $infoprice, $infoimage, $infodesc) = mysqli_fetch_row($info);

            print(populateModal($infoname, $infoprice, $infoimage, $infodesc, $infonum));
        } else {
            print(populateModal("Product Not Found", $infonum, "", "We couldn't find info on that product in our records"));
            
        }

        //create a modal using the info returned from the database.  The modal will include an add to cart button
        //when pushed it will post data so that we can add to our cart
        function populateModal($title, $price, $image, $description, $infonum) {
            $str = "<div class=\"modal-dialog\" role=\"document\"><div class=\"modal-content\">"
                    . "<div class=\"modal-header\"><h5 id = \"serviceInfoName\" class=\"modal-title\">" . $title . "</h5>"
                    . "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">"
                    . "<span aria-hidden=\"true\">&times;</span></button></div>"
                    . "<div class=\"modal-body\"><img id=\"serviceInfoImage\" src=\"" . $image . "\">"
                    . "<h5>$" . $price . "</h5>"
                    . "<p id=\"serviceInfoDescription\">" . $description . "</p></div>"
                    . "<div class=\"modal-footer\">"
                    ."<form id=\"addFromInfo\" action=\"cart.php\" method=\"Post\"><button type=\"submit\" name = \"addFromInfo\" value=\"$infonum\"class=\"btn btn-primary\">Add To Cart</button>"
                    . "</form><button type=\"button\" class=\"btn btn-primary\""
                    . " data-dismiss=\"modal\">Close</button></div></div></div>";

            return $str;
        }


//                   
//                    <form id="cart" action="cart.php" method="Post">
//                    
//                        <button type="button" class="btn btn-primary">Add To Cart</button>
//                        
        

