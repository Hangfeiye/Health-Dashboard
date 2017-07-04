<!DOCTYPE html>
<html>
<title>My HealthDashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-blue w3-large" style="z-index:4">
  <a href="index.php"><span class="w3-bar-item w3-right">Logout</span></a>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
   <?php 
   include('template.php');
   if(isset($_SESSION['Id'])) {
    $content=<<<END
     Welcome,{$_SESSION['userid']}
END;
   }
echo $content;
?>
     <br>
      <a href="https://accounts.google.com/signin/v2/sl/pwd?flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="loginindex.php" class="w3-bar-item w3-button w3-padding w3-hover-orange"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="mybodymeasurements.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-eye fa-fw"></i>    BMI Calculator</a>
    <a href="healthrecord.php" class="w3-bar-item w3-button w3-padding w3-hover-orange"><i class="fa fa-history fa-fw"></i>  HealthRecord</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My HealthDashboard</b></h5>
  </header>

<div id="main" class="w3-row-padding w3-margin-bottom">
<section class="containersss">
<h1>Body Mass Index Calculator</h1>
<p>Enter your height: <input type="text" id="height"/>
    <select type="multiple" id="heightunits">
        <option value="metres" selected="selected">metres</option>
        <option value="inches">inches</option>
    </select>
     </p>
<p>Enter your weight: <input type="text" id="weight"/>
    <select type="multiple" id="weightunits">
        <option value="kg" selected="selected">kilograms</option>
        <option value="lb">pounds</option>
    </select>
</p>
<input type="submit" value="Calculate" onclick="computeBMI();">
<h1>Your BMI is: <span id="output">?</span></h1>

<h2>This means you are: <span id="comment"> ?</span> </h2> 
  </section>
  </div>
<script type="text/javascript">
    function computeBMI()
    {
        //Obtain user inputs
        var height=Number(document.getElementById("height").value);
        var heightunits=document.getElementById("heightunits").value;
        var weight=Number(document.getElementById("weight").value);
        var weightunits=document.getElementById("weightunits").value;


        //Convert all units to metric
        if (heightunits=="inches") height/=39.3700787;
        if (weightunits=="lb") weight/=2.20462;

        //Perform calculation
        var BMI=weight/Math.pow(height,2);

        //Display result of calculation
        document.getElementById("output").innerText=Math.round(BMI*100)/100;

        var output =  Math.round(BMI*100)/100
        if (output<18.5)
        document.getElementById("comment").innerText = "Underweight";
      else   if (output>=18.5 && output<=25)
        document.getElementById("comment").innerText = "Normal";
     else   if (output>=25 && output<=30)
        document.getElementById("comment").innerText = "Obese";
     else   if (output>30)
        document.getElementById("comment").innerText = "Overweight";
       // document.getElementById("answer").value = output; 
    }
</script>
  <br>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by Group 12</p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>