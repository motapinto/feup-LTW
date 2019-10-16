<html>
    <body>
         <?php

            $num1 = $_GET['num1'];
            $num2 = $_GET['num2'];

            function addNumbers($num1, $num2){
                        
                return $num1 + $num2;

            }

            echo "$num1 + $num2 = ". addNumbers($num1, $num2);
            echo "<br><br>";
            echo "<a href=form2.html>Click me </a>"
         ?>
        
    </body>
</html>