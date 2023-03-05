<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Check Us Out</title>
        <?php
        include 'header.php';
        ?>
    <div class="pageWrapper">
        <div class = "container mainContent">
            <form class="" action="response.php" method="post">
                <h1>A bit about our products</h1>
                <div class="form-group row p-3 "> 


                    <label for="fname" class="col-sm-1 col-form-label-lg">Name</label>
                    <input class="col-sm-3" type="text" name="fname">
                </div>
                <div class="form-group row p-3"> 

                    <label for="state" class="col-sm-1 col-form-label-lg">State</label>
                    <input type="text" name="state" class="col-sm-3"> 
                    <div class="col-sm-3">Please use two character state</div>
                </div>
                <div class="form-group row p-3">

                    <label for="service" class="col-sm-1 col-form-label-lg">Service</label>
                    <select class="col-sm-3" name="service">
                        <option>--</option>
                        <option>Backpacking</option>
                        <option>E-Guides</option>
                        <option>Custom Trip Planning for Family</option>
                        <option>Custom Trip Planning for Couple</option>
                        <option>Custom Trip Planning for Corporate Retreat</option>
                    </select>

                </div>

                <div class="form-group row p-3">
                    <input class ="col-sm-3 mx-auto" type="submit">
                </div>


            </form>
            <?php
            // put your code here
            ?>
        </div>
        <?php
        include 'NavBar.php';
        ?>
    </div>
</body>
</html>
