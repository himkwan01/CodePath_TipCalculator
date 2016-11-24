<!DOCTYPE html>
<html>
    <head>

        <!-- character encoding declaration -->
        <meta charset="utf-8" />
        <title>CodePath - Tip Calculator</title>
    </head>
    <body>

        <!-- declare an array for radio button -->
        <?php $radio=array(10,15,20);?>

        <!-- default method is get, submitted data will be visible in the page
             address field
             another method is post -->
            <div style="background-color:lightblue;width:300px;height:300px;border:5px solid #cccccc;padding:10px;">
        <form action="tipcal.php" method="post" style="background-color:lightyellow;margin:auto;border:5px solid black;padding:10px;">

            <!-- fieldset is used to group related data in the form -->


                <!-- legend defines a caption for the <fieldset> element -->
                <center><h1>Tip Calculator<br></h1></center>

                <!-- one line text input field -->
                <p style="color:#CC33CC">Bill subtotal: $
                <input type="text" name="subtotal" 
                value='<?php echo $_POST?(double)$_POST["subtotal"]:"" ?>'
                size="8"><br></p>

                <!-- radio button -->
                <p>Tip percentage:<br></p>

                <!-- display the radio button with a for loop -->
                <?php 
                    for($i=0;$i<count($radio);$i++){
                        echo '<input type="radio" ';
                        echo 'name="percentage" ';
                        echo 'value='.$radio[$i]/100;
                        echo !$i?' checked>':'>';
                        echo $radio[$i];
                        echo "%";
                    }
                ?>
                <br>
                <!-- submit button -->
                <center><input type="submit" value="Submit"></center>




        <!-- evaluate the input -->
        <?php
            if($_POST){
                $subtotal=(double)$_POST["subtotal"];
                $percentage=(double)$_POST["percentage"];
                if((string)$subtotal==$_POST["subtotal"]){
                    if($subtotal>0){
                        $tip=$subtotal*$percentage;
                        $total=$subtotal+$tip;
                        echo "tip = \$$tip<br>";
                        echo "total = \$$total<br>";
                    }
                }
            }
        ?>
        </form>
        </div>
    </body>
</html>

