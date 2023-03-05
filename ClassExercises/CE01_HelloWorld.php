<!doctype html>


    <head>
        <meta charset="UTF-8">
        <title>Hello World</title>

        <?php
        /*Information about me*/
        $name = "Erin M.";
        $age = 33;
        $male = false;
        $icecream = "New York Super Fudge Chunk";
        $imageFile = "../img/planetExpress.png";
        ?>  
    </head>
    <body>
        <div>
            <?php
            echo "<p style = 'font:tahoma; color:red;'>Hello World, this is my first PHP page!</p>";
            print("<p>My name's: " . $name . "Who is $age years old, and likes $icecream ice-cream</p>");
            print('<p>We are using variables $name, $age, $icecream </p>');
            print("<img src='$imageFile' height=100");
            
            ?>
        </div>
        
    </body>
</html>
