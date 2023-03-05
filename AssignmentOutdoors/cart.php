<?php
session_start();

//check if the user is logged in.  If not send them to the log in page
if (!isset($_SESSION['loggedIn'])) {
    header("Location:login.php");
}

setlocale(LC_MONETARY, 'en-US');

$loggedInUser = $_SESSION['first'] . " " . $_SESSION['last'];  //get name of user who is logged in
$product_id = htmlentities($_POST['Select_Product']);  //product selected from dropdown
$action = htmlentities($_POST['action']); //what the user would like to do to the cart
$showInfoOn = htmlentities($_GET['Info']); //what product the user wants info on

$addFromInfo = htmlentities($_POST['addFromInfo']);//if the user presses add to cart from modal gather that info

/*if the user is adding from cart using the modal button add increment that product in the cart and 
change it so that $product_id equals the product chosen.  Later in the code the dropdown is created 
 * and the option that is selected is based on $product_id.  Setting $product_id to $addFromInfo makes it 
 * so that if the user adds a product from the modal that product is automatically selected when they close the modal
  */
if($addFromInfo != null)
{
    $_SESSION['cart'][$addFromInfo]++;
    $product_id = $addFromInfo;
}

//modify the cart session to show how many items are in cart using the ad, remove, and empty buttons
switch ($action) {
    case("Add"):
        $_SESSION['cart'][$product_id]++;
        break;
    case "Remove":
        $_SESSION['cart'][$product_id]--;
        if ($_SESSION['cart'][$product_id] <= 0) {
            //if quantity is zero or below remove it completely
            unset($_SESSION['cart'][$product_id]);
        }
        break;
    case "Empty":
        unset($_SESSION['cart']);
        break;
}
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
        <title>Cart</title>

        <script>
            /*
             * Uses ajax to get information about 
             */
            function productInfo(serviceid)
            {
                //creates the datafile with query string
                var data_file = "cartInfo.php?info=" + serviceid;
                //this is making the http request
                var http_request = new XMLHttpRequest();
                try
                {
                    // Opera 8.0+, Firefox, Chrome, Safari
                    http_request = new XMLHttpRequest();
                }
                catch (e)
                {
                    // Internet Explorer Browsers
                    try
                    {
                        http_request = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        try
                        {
                            http_request = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e)
                        {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                http_request.onreadystatechange = function ()
                {
                    if (http_request.readyState === 4)
                    {
                        var text = http_request.responseText;

                        //this is adding the elements to the HTML in the page
                        document.getElementById("productInfoModal").innerHTML = text;
                    }
                };
                http_request.open("GET", data_file, true);
                http_request.send();
            }
        </script>

        <?php
        include "header.php";
        ?>
    <div class="pageWrapper">
        <form id="cart" action="cart.php" method="Post">
            <div id="greeting">
                <?php
                require_once "DataBaseConnection.php";
                print("<h1>Hello $loggedInUser</h1>");
                print("<span>Please select one of our items: </span>");
                print("<select id='Select_Product' name='Select_Product' class'select'>");

                $search = "SELECT serviceName, serviceId FROM CompanyDB.Services order by serviceName";
                $return = $conndb->query($search);

                if (!$return) {
                    $message = "Whole query: " . $search;
                    echo $message;
                    die('Invalid query: ' . mysqli_error());
                }

                
                while ($row = mysqli_fetch_array($return)) {
                    if ($row['serviceId'] == $product_id) {
                        echo "<option value='" . $row['serviceId'] . "' selected='selected'>" . $row['serviceName'] . "</option>\n";
                    } else {
                        echo "<option value = '" . $row['serviceId'] . "'>" . $row['serviceName'] . "</option>\n";
                    }
                }
                ?>
                </select>
            </div>
            <div>
                <input type="submit" name="action" id="add" value="Add">
                <input type="submit" name="action" id="remove" value="Remove">
                <input type="submit" name="action" id="empty" value="Empty">
                <input type="button"  id="info" value="Info"  onclick="productInfo(document.getElementById('Select_Product').value)" class="" data-toggle="modal" data-target="#productInfoModal">

                </form>
                <?php
                if ($_SESSION['cart']) {

                    $numOfProducts = 0;

                    echo "<table class='table cartTable'><tr class='thead-dark'><th>Name</th><th>Qty</th><th>Cost</th></tr>";

                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $sql = "SELECT serviceName, servicePrice FROM CompanyDB.Services WHERE serviceId = " . $product_id;
                        $result = $conndb->query($sql);

                        $numOfProducts += $quantity;

                        if (mysqli_num_rows($result) > 0) {
                            list($name, $price) = mysqli_fetch_row($result);

                            $line_cost = $price * $quantity;
                            $total = $total + $line_cost;
                            echo "<tr>";

                            echo "<td>$name</td>";
                            echo "<td>" . $quantity . "</td>";
                            echo "<td>$" . money_format('%(#8n', $line_cost) . "</td>";
                            echo "</tr>";
                        }
                    }

                    echo "<tr class='table-dark'><td>Total</td><td>$numOfProducts</td><td>$" . money_format('%(#8n', $total) . " </td><tr></table>";
                } else {
                    echo "<table class='table cartTable'><tr class='thead-dark'><th>Cart</th></tr>";
                    echo "<tr><td>You have nothing in your cart</td></tr></table>";
                }
                ?>

            </div>
            <div id="productInfoModal" class="modal" tabindex="-1" role="dialog">
                
            </div>

            <?php
            include "NavBar.php";
            ?>
    </div>



</body>
</html>
