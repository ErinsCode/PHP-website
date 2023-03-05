<html>
    <head>
        <meta charset="UTF-8">
        <title>Rando Page</title>
       
        
    </head>
    <body>
        <?php
        $score = 0;
        print("<table><tr><th>Player</th><th>Computer</th><th>Rounds</th></tr>\n");
        
        /*
         * Play 10 rounds of the game.  Assign a number between 1 and 100 randomly to the player
         * and the computer.  If the player's number is higher than the computer's they get a point,
         * if it is lower, they get a point taken away, and if it is the same they get no point.
         */
        for($round = 0; $round < 10; $round++)
        {
            $playerNumber = rand(1,100);
            $computerNumber = rand(1,100);
            
            print("<tr><td>$playerNumber</td><td>$computerNumber</td>");
            
            if($playerNumber > $computerNumber)
            {
                print("<td>Player won this round</td></tr>");
                $score++;
                
            }
            elseif($playerNumber < $computerNumber)
            {
                print("<td>Player lost this round</td></tr>");
                $score--;
                
            }
            else
            {
                print("<td>Player tied this round</td></tr>");

            }   
            
        }
        
        print("<tr><td colspan=2>$score</td><td>Player Score</td></tr><table>\n");
        
        ($score > 0) ? print("<h2>Good Job!</h2>"): print("<h2>Sorry you lost</h2>");

        //Year of the---

        //Here you will write out a switch that will print out the year using the modulo(% 12)
        //Monkey, roster, dog, boar, rat, ox, tiger, rabbit, dragon, snake, horse, and lamb is the order, do not forget a default case
        
        $year = date("Y");
        print("<p>It is the year of the:<br>");
        
        switch($year % 12)
        {
             case 0:
                 echo 'Monkey</p>';
                 break;
             case 1:
                 echo 'Roster</p>';
                 break;
             case 2:
                 echo 'Dog</p>';
                 break;
             case 3:
                 echo 'Boar</p>';
                 break;
             case 4:
                 echo 'Rat</p>';
                 break;
             case 5:
                 echo 'Ox</p>';
                 break;
             case 6:
                 echo 'Tiger</p>';
                 break;
             case 7:
                 echo 'Rabbit</p>';
                 break;
             case 8:
                 echo 'Dragon</p>';
                 break;
             case 9:
                 echo 'Snake</p>';
                 break;
             case 10:
                 echo 'Horse</p>';
                 break;
             case 11:
                 echo 'Lamb</p>';
                 break;
             default:
                 echo "Something went wrong</p>";
            
        }
       
        ?>
    </body>
</html>

