<!DOCTYPE html>
<html style="margin:auto">
  <head>

  <!-- character encoding declaration -->
  <meta charset="utf-8" />
  <title>CodePath - Tip Calculator</title>
  <style>
    .tooltip{
        position:relative;
        display:inline-block;
    }
    .tooltip .tooltiptext{
        visibility:hidden;
        width:120px; 
        background-color:#F5ECCE;
        text-align:center;
        border-radius:6px;
        color:black;
        /* position the tooltip */
        position:absolute;
        z-index:1;
        opacity:0;
        transition:2s;
    }
    .tooltip:hover .tooltiptext{
        visibility:visible;
        opacity:1;
    }
    h1{
      margin:10px;
    }
    p{
      margin:10px 5px;
    }
    div.header{
        text-align:center;
        background-color:gray;
        color:white;
        width:360px;
    }
    div.footer{
        text-align:center;
        background-color:white;
        width:360px;
    }
    div.outter-panel{
      background-color:lightblue;
      width:320px;
      height:400px;
      border:5px solid #cccccc;
      padding:15px;
    }

    #inner-form{
      background-color:white;
      margin:auto;
      border:1px solid black;
      padding:15px;
    }
    div.output{
      margin:auto;
      border:1px solid blue;
      padding:15px;
    }
    p{
      width:300px;
    }
  </style>
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
  <div class="header">Codepaht pre-work Tip Calculator</div>
  <div class="outter-panel">
  <form id="inner-form" action="Tipcal.php" method="post">
    <?php 
    // get previous value if any
    $subtotal_text=$_POST?(double)$_POST["subtotal"]:1;
    $percentage=$_POST?$_POST["percentage"]*100:10;
    $cPercentage=$percentage=="OTHER"?(double)$_POST["cPercentage"]:"";
    $split=$_POST?(double)$_POST["split"]:1;
    ?>

    <center><h1>Tip Calculator<br></h1></center>

    <!-- subtotal texfield if previoud input is invalid, change color to red -->
    <p class="tooltip">
    <font color=<?php echo ((double)$subtotal_text>0 || 
                          (string)$subtotal_text=="")? "black":"red"; ?>
    >
      Bill subtotal: $
      <input type="text" name="subtotal" value='<?php echo $subtotal_text ?>'
          size="5">&nbsp
          <span class="tooltiptext">Positive number!</span> 
    </p> <!-- subtotal textfield ends -->

    <!-- radio buttons if input is invalid, change color to red -->
    <p class="tooltip">
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
      <input type="text" name="cPercentage" 
              value='<?php echo $cPercentage ?>' size="3">
      %&nbsp
      <span class="tooltiptext">Positive number!</span>
      
    </p> <!-- tip percentage radio buttons ends -->
    <!-- split textfield if previous input is invalid, change color to red -->
    <p class="tooltip">
    <font color=<?php echo $split>0?"black":"red"; ?>>
      <!-- default value for split is 1 -->
      Split:
      <input type="text" name="split" value=<?php echo $split ?> size="3">
      &nbsp
      <span class="tooltiptext">Positive integer!</span>
    </p> <!-- split textfield ends -->

    <!-- submit button -->
    <center><input type="submit" value="Submit"></center>

    <!-- evaluate the input -->
    <?php
    if($_POST){        
      $subtotal=(double)$_POST["subtotal"];
      $percentage=($_POST["percentage"]=="OTHER"?
          (double)$_POST["cPercentage"]/100:$_POST["percentage"]);
      $split=(double)$_POST["split"];
      if((string)$subtotal==$_POST["subtotal"] && 
          (double)$percentage>0 && 
          (double)$split>0){
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

