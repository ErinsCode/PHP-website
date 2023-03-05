<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$CapName = htmlentities($_POST['CapName']);  //correct for xxs vulnerability
$CapName = strtolower($CapName); //make all letters lowercase
$CapName = ucwords($CapName); //make first letters uppercase

$CapAge = htmlentities($_POST['CapAge']);
$ShipName = htmlentities($_POST['ShipName']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet"> 
        <title>Captain Result</title>
        <style>
            body{
                background-color: black;
                color: #efefee;
                font-family: 'Roboto Condensed', sans-serif;
                background-image: radial-gradient(white, #e5daca, #717577, #7d6151,#363643,#363643, black 60%);
                width: 100%;
                background-repeat: no-repeat;
                background-size: 200% 150%;
                background-attachment: fixed;
            }

            #resultHeader
            {
                font-size: 2em;
                font-weight: bold;
            }
            
            .sectionHeader
            {
                font-size: 1.5em;
            }
            
            .sectionHeader li
            {
                font-size: 1.25em;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <?php
                        $pos = 0;

                        print("<p class ='title' id = 'resultHeader'>Captain $CapName at the age of $CapAge took over the ship $ShipName"
                                . " and here is some of their past</p>");

                        /* Open the early file text file and read through it and save each line into an array, and 
                          then close the file.  Shuffle the contents of the array so that it is in a random order and then print the contents
                         * of the first two elements of the array. */

                        $EarlyFile = fopen("EarlyYears.txt", "r") or die("Unable to open file!");
                        while (!feof($EarlyFile)) {
                            $randonEarly[$pos] = fgets($EarlyFile);
                            $pos++;
                        }
                        fclose($EarlyFile);

                        shuffle($randonEarly);
                        print("<p class='sectionHeader'>The early career started with: <ul><li>"
                                . $randonEarly[0] . "</li><li>" . $randonEarly[1] . "</li></ul></p>");

                        //calculate number of tours the captain has done based on their age
                        if ($CapAge > 25) {
                            $tours = 4 + ($CapAge - 26);
                        } else {
                            $tours = floor(($CapAge - 17) / 2);
                        }

                        /* Make an array of the contents of file Tours.txt with /n as a delimiter. file_get_contents
                         * will open and close the file.  Shuffle the array
                          and then print out the number of tours the captain has done (as decided by their age) */
                        $randonTours = explode("\n", file_get_contents("Tours.txt"));
                        shuffle($randonTours);
                        print("<p class='sectionHeader'>The career looks like this <ul>");
                        for ($y = 0; $y < $tours; $y++) {
                            print("<li>" . $randonTours[$y] . "</li>");
                        }
                        print("</ul></p>");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
