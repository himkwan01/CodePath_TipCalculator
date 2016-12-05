<!DOCTYPE html>
<!-- 
    Aurthor:  Tsz Him Kwan
    Date:     11-23-2016
    Purpose:  CodePath - Web Security pre-work
              Tip Calculator
-->
<html style="margin:auto">
  <head>

  <!-- character encoding declaration -->
  <meta charset="utf-8" />
  <title>CodePath - Tip Calculator</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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
  $split=1;
  ?>

  <!-- default method is get, submitted data will be visible in the page address
       field another method is post -->
  <div class="header">Codepath pre-work Tip Calculator</div>
  <div class="outter-panel">
  <form id="inner-form" action="Tipcal.php" method="post">
    <?php 
    // get previous value if any
    $subtotal_text=$_POST?(double)$_POST["subtotal"]:1;
    $percentage=$_POST?$_POST["percentage"]*100:10;
    $cPercentage=$percentage=="OTHER"?(double)$_POST["cPercentage"]:"";
    $split=$_POST?$_POST["split"]:'1';
    ?>

    <center><h1>Tip Calculator<br></h1></center>

    <!-- subtotal texfield if previoud input is invalid, change color to red -->
    <p>
    <font color=<?php echo ((double)$subtotal_text>0 || 
                          (string)$subtotal_text=="")? "black":"red"; ?>
    >
      Bill subtotal: $
      <tooltip>
      <input type="text" name="subtotal" value='<?php echo $subtotal_text ?>'
          size="5">
          <span class="tooltiptext">Positive number!</span> 
      </tooltip>
    </p> <!-- subtotal textfield ends -->

    <!-- radio buttons if input is invalid, change color to red -->
    <p>
    <font color=
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
      }   // ends for-loop

      echo '<br>';

      // create radio button for custom tip precentage
      echo '<input type="radio" name="percentage" value="OTHER" ';
      if((string)$cPercentage!="")
        echo 'checked';
      echo '>';
      ?>
      Custom

      <!-- custome textfield -->
      <tooltip>
      <input type="text" name="cPercentage" 
              value='<?php echo $cPercentage ?>' size="3">
      %
      <span class="tooltiptext">Positive number!</span>
      </tooltip>
    </p> <!-- tip percentage radio buttons ends -->
    <!-- split textfield if previous input is invalid, change color to red -->
    <p>
    <font color=<?php echo ((int)$split>0 && ctype_digit($split))?
        "black":"red"; ?>>
      <!-- default value for split is 1 -->
      Split:
      <tooltip>
      <input type="text" name="split" value=
        <?php echo (int)$split?(int)$split:'1' ?> size="3">
      <span class="tooltiptext">Positive integer!</span>
      </tooltip>
    </p> <!-- split textfield ends -->

    <!-- submit button -->
    <center><input type="submit" value="Submit"></center>

    <!-- evaluate the input -->
    <?php
    if($_POST){        
      $subtotal=(double)$_POST["subtotal"];
      $percentage=($_POST["percentage"]=="OTHER"?
          (double)$_POST["cPercentage"]/100:$_POST["percentage"]);
      $split=$_POST["split"];
      if((string)$subtotal==$_POST["subtotal"] && 
          (double)$percentage>0 && 
          ctype_digit($split) && $split){
        if($subtotal>0){
          $tip=$subtotal*$percentage;
          $total=$subtotal+$tip;
          printf ('<br><div class="output">');
          printf ("tip : \$%.2f<br>",$tip);
          printf ("total : \$%.2f<br>",$total);
          if($split>1){
            printf ("Tip each : \$%.2f<br>",$tip/$split);
            printf ("Total each : \$%.2f<br>",$total/$split);
          }
          printf ("</div>");
        }
      }
    }
    ?>
    </form> <!-- form ends -->
    </div>
    <div class="footer">
    <a href="https://github.com/himkwan01">
      Tsz Him Kwan &copy2017 CodePath@UCSD
    </div>
  </body>
</html>

