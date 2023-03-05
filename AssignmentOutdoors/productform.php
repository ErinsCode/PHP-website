<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        // put your code here
        print <<<HTML
        
        <div class="container mainContent">
        <form name="productForm" method="post" action="results.php" >
        
                <div class="form-group row p-3 "> 

                <label for="formOption" class="col-sm-3 col-form-label-md">What Would You Like To Do?</label>
                <select class="col-sm-3" name="formOption">
                        <option>--</option>
                        <option value="search">Search for Service</option>
                        <option value="create">Create Service</option>
                        <option value="update">Update Service</option>
                    </select>
        </div>
          <div class="form-group row p-2">
                    <label for="serviceName" class="col-sm-3 col-form-label-md" max-length = "50">Service Name</label>
                    <input class="col-sm-3" type="text" name="serviceName">
                </div>
          <div class="form-group row p-2">
                    <label for="servicePrice" class="col-sm-3 col-form-label-md">Service Price</label>
                    <input class="col-sm-3" type="number" step=".01" min = "0" max="99999.99" name="servicePrice">
                </div>
          <div class="form-group row p-2">
                    <label for="imageurl" class="col-sm-3 col-form-label-md" maxlength="500">Image URL</label>
                    <input class="col-sm-5" type="url" name="imageurl">
                </div>
          <div class="form-group row p-2">
                    <label for="description" class="col-sm-3 col-form-label-md" maxlength="500">Service Description</label>
                    <textarea  id = "description" class = "col-sm-5" name="description" rows="4" ></textarea>
                </div>
                <div class="form-group row p-3 mt-3">
                    <input class ="col-sm-3 mx-auto" type="submit">
                </div>
            </form>
        
        </div>    
        
HTML;
        ?>
    </body>
</html>
