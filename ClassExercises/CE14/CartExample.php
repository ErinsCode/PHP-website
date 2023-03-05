<?php
require_once './DataBaseConnection.php';

session_start();
setlocale(LC_MONETARY, 'en-US');
$product_id = $_POST['Select_Product'];
$action = $_POST['action'];

//add product to, subtract product from, or empty the cart
switch ($action) {
    case "Add":
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

<html>
    <head>
        <meta charset="UTF-8">
        <title>Space Station Market</title>

        <script>
            function productInfo(key)
            {
                //creates the datafile with query string
                var data_file = "CartInfo.php?info=" + key;
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
                    if (http_request.readyState == 4)
                    {
                        var text = http_request.responseText;

                        //this is adding the elements to the HTML in the page
                        document.getElementById("productInformation").innerHTML = text;
                    }
                }
                http_request.open("GET", data_file, true);
                http_request.send();
            }
        </script>

<?php
include 'Header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <div>

                </div></div>
            <div class="col-sm-8">
                <form action="CartExample.php" method="Post">
                    <div >
                        <p><span class="text">Please Select a product:</span>
                            <select id="Select_Product" name="Select_Product" class="select">
<?php
$search = "SELECT ResName, idResources FROM CSIS2440.Resources order by ResName";
$return = $con->query($search);

if (!$return) {
    $message = "Whole query: " . $search;
    echo $message;
    die('Invalid query: ' . mysqli_error());
}

while ($row = mysqli_fetch_array($return)) {
    if ($row['idResources'] == $product_id) {
        echo "<option value='" . $row['idResources'] . "' selected='selected'>" . $row['ResName'] . "</option>\n";
    } else {
        echo "<option value = '" . $row['idResources'] . "'>" . $row['ResName'] . "</option>\n";
    }
}
?>
                            </select></p>
                        <table>
                            <tr>
                                <td>
                                    <input id="button_Add" type="submit" value="Add" name="action" class="button"/>
                                </td>
                                <td>
                                    <input name="action" type="submit" class="button" id="button_Remove" value="Remove"/>
                                </td>
                                <td>
                                    <input name="action" type="submit" class="button" id="button_empty" value="Empty"/>
                                </td>
                                <td>
                                    <input name="action" type="button" class="button" id="button_Info" value="Info" onclick="productInfo(document.getElementById('Select_Product').value)"/>
                                </td>
                            </tr>                    
                        </table>

                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" id="productInformation">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div id="Display_cart" class="col-sm-8">
<?php
//if cart not empty show car
if ($_SESSION['cart']) {
    echo "<table border=\"1\" padding\"3\" width=\"640px\"><tr><th>Name</th>Quantity</th><th>Price</th>"
    . "<th width=\"80px\">Line Cost</th></tr>";

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT ResName, ResPPU FROM CSIS2440.Resources WHERE idResources = " . $product_id;
        $result = $con->query($sql);

        if (mysqli_num_rows($result) > 0) {
            list($name, $price) = mysqli_fetch_row($result);

            $line_cost = $price * $quantity;
            $total = $total + $line_cost;
            echo "<tr>";

            echo "<td align=\"left\" width=\"450px\">$name</td>";
            echo "<td align=\"center\" with=\"75px\">" . money_format('%(#8n', $price) . "</td>";
            echo "<td align=\"center\">" . money_format('%(#8n', $line_cost) . "</td>";
            echo "</tr>";
        }
    }

    //show total 
    echo "<tr>";
    echo "<td align=\"right\">Total Weight</td><td align=\"right\">$totalWeight</td><td align=\"right\">Total</td>";
    echo "<td align=\"right\">" . money_format('%(#8n', $total) . "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "You have no items in your shopping cart.";
    
}

mysqli_close($con);
?>

            </div>
        </div>
    </div>
                <?php
                include "Footer.php";
                ?>
