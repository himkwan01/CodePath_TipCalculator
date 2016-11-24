<!DOCTYPE html>
<html>
    <head>

        <!-- character encoding declaration -->
        <meta charset="utf-8" />
        <title>CodePath - Tip Calculator</title>
    </head>
    <body>

        <!-- declare an array for radio button -->
        <?php
            // declare variable and initialize
            $radio=array(10,15,20);
            $subtotal=0;
            $percentage=0.1;
            $valid=true;
            $subtotal_text="";
        ?>

        <!-- default method is get, submitted data will be visible in the page
             address field
             another method is post -->
            <div style="background-color:lightblue;width:320px;height:400px;border:5px solid #cccccc;padding:10px;">
        <form action="Tipcal.php" method="post" style="background-color:lightyellow;margin:auto;border:1px solid black;padding:10px;">
                <?php 
                    $subtotal_text=$_POST?(double)$_POST["subtotal"]:1;
                    $percentage=$_POST?$_POST["percentage"]*100:10;
                    $cPercentage=$percentage=="OTHER"?(double)$_POST["cPercentage"]:"";
                ?>
                <center><h1>Tip Calculator<br></h1></center>
                <!-- one line text input field -->
                
                <p>
                <font color=
                <?php echo ((double)$subtotal_text>0 || 
                    (string)$subtotal_text=="")? "black":"red"; ?>
                >
                Bill subtotal: $
                
                <input type="text" name="subtotal" 
                value='<?php echo $subtotal_text ?>'
                size="8"><br></p>

                <!-- radio button -->
                <p><font color=
                <?php echo ((double)$cPercentage>0 || 
                (string)$cPercentage=="")?"black":"red"; ?>
                >
                Tip percentage:<br>

                <!-- display the radio button with a for loop -->
                <?php 
                    for($i=0;$i<count($radio);$i++){
                        echo '<input type="radio" ';
                        echo 'name="percentage" ';
                        echo 'value='.$radio[$i]/100;
                        if($radio[$i]==$percentage){
                            echo " checked";
                        }
                        echo '>';
                        echo $radio[$i];
                        echo "%";
                    }
                    echo '<input type="radio" name="percentage" value="OTHER" ';
                    if((string)$cPercentage!="")echo 'checked';
                    echo '>';
                ?>
                Custom
                <!-- custome button -->
                <input type="text" name="cPercentage"
                value='<?php echo $cPercentage ?>' size="3">%
                </p>
                <br>
                <!-- submit button -->
                <center><input type="submit" value="Submit"></center>




        <!-- evaluate the input -->
        <?php
            if($_POST){
                
                $subtotal=(double)$_POST["subtotal"];
                $percentage=($_POST["percentage"]=="OTHER"?
                            (double)$_POST["cPercentage"]/100:$_POST["percentage"]);
                if((string)$subtotal==$_POST["subtotal"] && 
                    (double)$percentage>0){
                    if($subtotal>0){
                        $tip=$subtotal*$percentage;
                        $total=$subtotal+$tip;
                        printf ("tip = \$%.2f<br>",$tip);
                        printf ("total = \$%.2f<br>",$total);
                    }
                    // non-positive number
                    else{
                        $valid=false;
                    }
                }
                // not number
                else{
                    $valid=false;
                }
            }
        ?>

        </form>
        </div>
    </body>
</html>

