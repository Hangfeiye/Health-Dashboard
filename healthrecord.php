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
<style type="text/css">
.autoScroll
{
  overflow:auto;
}
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
    <a href="mybodymeasurements.php" class="w3-bar-item w3-button w3-padding w3-hover-orange"><i class="fa fa-eye fa-fw"></i>    BMI Calculator</a>
    <a href="healthrecord.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-history fa-fw"></i>  HealthRecord</a>
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


<!-- recordtable -->
  <div class="w3-row-padding w3-margin-bottom autoScroll" id="content1" >
<?php
require_once('template.php');
$content=<<<END
<table class="w3-table w3-bordered" id="tableid">
<tbody id="tid">
<tr>
<td>Date time</td>    
END;

$query=<<<END
SELECT created_at FROM daily_steps WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
    <td>{$row->created_at}</td>
END;
}
}
$content.=<<<END
</tr>
 <tr>
 <td>Steps</td>
END;


$query=<<<END
SELECT created_at,steps FROM daily_steps WHERE id={$_SESSION['Id']} ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
            <td>{$row->steps}</td>
END;
}
}            
$content.=<<<END
</tr>
 <tr>
 <td>Energy expenditure</td>
END;

$query=<<<END
SELECT created_at,energy_expenditure FROM daily_energy_expenditure WHERE id={$_SESSION['Id']} ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
        <td>{$row->energy_expenditure}</td>
END;
}
}

$content.=<<<END
</tr>
 <tr>
 <td>Walk distance</td>
END;

$query=<<<END
SELECT created_at,walk_distance FROM daily_walk_distance WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
      <td>{$row->walk_distance}</td>        
END;
}
}

$content.=<<<END
</tr>
 <tr>
 <td>Bed time</td>
END;


$query=<<<END
SELECT created_at,bed_time FROM daily_bed_time WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
            <td>{$row->bed_time}</td>
END;
}
}

$content.=<<<END
</tr> 
 <tr>
 <td>Get up</td>
END;

$query=<<<END
SELECT created_at,get_up FROM daily_get_up WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
            <td>{$row->get_up}</td>
END;
}
}

$content.=<<<END
</tr>
 <tr>
 <td>Sleeping hours</td>
END;

$query=<<<END
SELECT created_at,sleeping_hours FROM daily_sleeping_hours WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <td>{$row->sleeping_hours}</td>    
END;
}
}
$content.=<<<END
</tr>
 <tr>
 <td>Naps times</td>
END;


$query=<<<END
SELECT created_at,naps_times FROM daily_naps_times WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
   <td>{$row->naps_times}</td>    
END;
}
}
$content.=<<<END
</tr>
 <tr>
 <td> Outdoors temperature</td>
END;

$query=<<<END
SELECT created_at,outdoors_temperature FROM daily_outdoors_temperature WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
           <td>{$row->outdoors_temperature}</td>        
END;
}
}

$content.=<<<END
</tr>
</tbody>
</table>

END;
echo $content;
?>

<!-- clearbutton -->
<div>
<form action="cleartable.php" method="POST">
<input type="submit" value="clear" name="clear">
</form>
</div>


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