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
<div class="w3-bar w3-top w3-blue w3-large" style="z-index:2">
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
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="mybodymeasurements.php" class="w3-bar-item w3-button w3-padding w3-hover-orange"><i class="fa fa-eye fa-fw"></i> BMI Calculator</a>
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




<div>
  <?php
  require_once('template.php');
  //Steps
  $query=<<<END
SELECT steps FROM daily_steps WHERE id={$_SESSION['Id']} ORDER BY created_at ASC 
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
<br/>
<br/>
    <div class="w3-quarter">
      <div class="w3-container w3-purple w3-padding-16">
        <div class="w3-left"><i class="fa fa-paw w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->steps}</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id01').style.display='block'">Steps</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
  <br/>
<br/>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-paw w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Steps</h4></div>
      </div>
    </div>
END;
}
echo $content;
//
  $content=<<<END
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Steps</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Steps</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,steps FROM daily_steps WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->steps}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;


//Energy_expenditure
$query=<<<END
SELECT energy_expenditure FROM daily_energy_expenditure WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-hand-rock-o w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->energy_expenditure} kCal</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id02').style.display='block'">Energy expenditure</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-hand-rock-o w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Energy expenditure</h4></div>
      </div>
    </div>

END;
}
echo $content;

//
$content=<<<END
<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Energy expenditure</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Energy expenditure</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,energy_expenditure FROM daily_energy_expenditure WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->energy_expenditure}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;



//Walk_distance
$query=<<<END
SELECT walk_distance FROM daily_walk_distance WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-road w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->walk_distance} Km</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id03').style.display='block'">Walk distance</h4></div>
      </div>
    </div>

END;
}
}else{
  $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-road w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Walk distance</h4></div>
      </div>
    </div>

END;
}
echo $content;

//
$content=<<<END
<div id="id03" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id03').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Walk distance</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Walk distance</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,walk_distance FROM daily_walk_distance WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->walk_distance}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;



//Bed_time
$query=<<<END
SELECT bed_time FROM daily_bed_time WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-hotel w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->bed_time}</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id04').style.display='block'">Bed time</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-hotel w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Bed time</h4></div>
      </div>
    </div>
END;
}
echo $content;

//
$content=<<<END
<div id="id04" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id04').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Bed time</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Bed time</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,bed_time FROM daily_bed_time WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->bed_time}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;



//Get_up
$query=<<<END
SELECT get_up FROM daily_get_up WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
<br/>
<br/>
    <div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16">
        <div class="w3-left"><i class="fa fa-clock-o w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->get_up}</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id05').style.display='block'">Get up</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
  <br/>
<br/>
    <div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16">
        <div class="w3-left"><i class="fa fa-clock-o w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Get up</h4></div>
      </div>
    </div>
END;
}
echo $content;

//
$content=<<<END
<div id="id05" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id05').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Get up</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Get up</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,get_up FROM daily_get_up WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->get_up}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;


//Sleeping_hours
$query=<<<END
SELECT sleeping_hours FROM daily_sleeping_hours WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-hourglass-half w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->sleeping_hours}</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id06').style.display='block'">Sleeping hours</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-hourglass-half w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Sleeping hours</h4></div>
      </div>
    </div>
END;
}
echo $content;

//
$content=<<<END
<div id="id06" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id06').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Sleeping hours</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Sleeping hours</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,sleeping_hours FROM daily_sleeping_hours WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->sleeping_hours}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;


//Naps_times
$query=<<<END
SELECT naps_times FROM daily_naps_times WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-brown w3-padding-16">
        <div class="w3-left"><i class="fa fa-home w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->naps_times}</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id07').style.display='block'">Naps times</h4></div>
      </div>
    </div>
END;
}
}else{
  $content=<<<END
<div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-home w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Naps times</h4></div>
      </div>
    </div>
END;
}
echo $content;

//
$content=<<<END
<div id="id07" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id07').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Naps times</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Naps_times</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,naps_times FROM daily_naps_times WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->naps_times}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;


//Outdoors_temperature
$query=<<<END
SELECT outdoors_temperature FROM daily_outdoors_temperature WHERE id={$_SESSION['Id']}
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-lime w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-thermometer-quarter w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>{$row->outdoors_temperature} ℃</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4 onclick="document.getElementById('id08').style.display='block'">Outdoors temperature</h4></div>
      </div>
    </div>
</div>
END;
}
}else{
   $content=<<<END
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-thermometer-quarter w3-xxxlarge"></i></div>
        <div class="w3-center">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <div class="w3-center"><h4>Outdoors temperature</h4></div>
      </div>
    </div>
</div>
END;
}
echo $content;

//
$content=<<<END
<div id="id08" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id08').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Outdoors temperature</h2>
      </header>
      <div class="w3-container">
        <table class="w3-table w3-bordered">
          <tr>
            <th>Date time</th>
            <th>Outdoors_temperature</th>
          </tr>
END;
//
  $query=<<<END
SELECT created_at,outdoors_temperature FROM daily_outdoors_temperature WHERE id={$_SESSION['Id']}
ORDER BY created_at DESC
END;
$res=$mysqli->query($query);
if($res->num_rows>0){
  while($row=$res->fetch_object()){
    $content.=<<<END
         <tr>
            <td>{$row->created_at}</td>
            <td>{$row->outdoors_temperature}</td>
            </tr>
END;
}
}
$content.=<<<END
</table>
  </div>
    </div>
  </div>
END;
echo $content;
 ?>
 <br>



 <div class="w3-quarter">
 <div class="w3-center">
 <h4>ADD INFORMATION</h4>
<button class="w3-button w3-circle w3-teal w3-hover-blue" onclick="document.getElementById('id09').style.display='block'">+</button>
</div>
</div>




<div id="id09" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id09').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>
     <div id="main">
     <table>
                    <section class="containerss">

<form method="post" action="loginindex.php">

<tr>     
        <td width="25%" height="35" align="right">Date:</td>
        <td width="75%" class="category">
          <script>
var date = new Date();  
var y = date.getFullYear();     
var m =date.getMonth()+1;  
var d = date.getDate(); 
document.write(y+"-"+m+"-"+d);
</script> 
        </td>
      </tr>
<tr>     
        <td width="25%" height="35" align="right">Steps:</td>
        <td width="75%" class="category">
          <input type="text" style="width:300px" name="steps">  
        </td>
      </tr>


      <tr>     
        <td align="right" height="35">Energy expenditure(ka):</td>
        <td class="category">
         <input type=text style="width:300px" name="energy_expenditure">  
        </td>
      </tr>


      <tr> 
        <td align="right" height="30">Walk distance(km):</td>
        <td class="category">
         <input type="text" name="walk_distance" style="width:300px">
        </td>
      </tr>
      


      <tr>  
        <td align="right" height="35">Bed time:</td>
        <td class="category">
         <input type="text" style="width:300px" name="bed_time"> 
        </td>
      </tr>



      <tr>          
        <td align="right" height="35">Get up:</td>
        <td class="category">
         <input type="text" style="width:300px" name="get_up">  
        </td>
      </tr>
  



      <tr>  
        <td align="right" height="35">Sleeping hours:</td>
        <td class="category">
        <input type="text" name="sleeping_hours" style="width:300px">
        </td>
      </tr>


      <tr>    
        <td align="right" height="35">Naps times:</td>
        <td class="category">
         <input type="text" name="naps_times" style="width:300px">
        </td>
      </tr> 



      <tr> 
        <td align="right" height="35">Outdoors temperature(℃):</td>
        <td class="category">
         <input type="text" name="outdoors_temperature" style="width:300px">
        </td>
      </tr>   

      <tr>   
        <td height="35"> </td>
        <td class="category">
           <input type="submit" name="submit" value="Submit">    
           <input type="reset" value="Reset">   
        </td>
      </tr>  
</form>
</section>
  </table>
 </div>


<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id09').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

      </div>

    </div>
  </div>

<?php
include_once('template.php');
if(isset($_POST['submit'])){
  $query=<<<END
  INSERT INTO daily_steps(id,steps) VALUES({$_SESSION['Id']},'{$_POST['steps']}')
END;
$mysqli->query($query);
$query=<<<END
  INSERT INTO daily_energy_expenditure(id,energy_expenditure) VALUES({$_SESSION['Id']},'{$_POST['energy_expenditure']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_walk_distance(id,walk_distance) VALUES({$_SESSION['Id']},'{$_POST['walk_distance']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_bed_time(id,bed_time) VALUES({$_SESSION['Id']},'{$_POST['bed_time']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_get_up(id,get_up) VALUES({$_SESSION['Id']},'{$_POST['get_up']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_sleeping_hours(id,sleeping_hours) VALUES({$_SESSION['Id']},'{$_POST['sleeping_hours']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_naps_times(id,naps_times) VALUES({$_SESSION['Id']},'{$_POST['naps_times']}')
END;
$mysqli->query($query);

$query=<<<END
  INSERT INTO daily_outdoors_temperature(id,outdoors_temperature) VALUES({$_SESSION['Id']},'{$_POST['outdoors_temperature']}')
END;
$mysqli->query($query);

echo "<script>alert('added successfully!');history.go(-1);</script>";
}
?>



<!-- the charts of steps -->
<?php

/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

   include("fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "hanye16";  // MySQL username
   $passdb = "cymr6RX11f";  // MySQL password
   $namedb = "hanye16_db";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>

<html>
   <head>
  	<title>chart</title>
    <link  rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <!-- <link  rel="stylesheet" type="text/css" href="assets/css/style.css" /> -->

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts.theme.ocean.js"></script>
  </head>

   <body>
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT id, steps FROM daily_steps ORDER BY created_at DESC LIMIT 30";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "Steps per day",
                  "showValues" => "1",
                  "theme" => "zune",
            "xAxisName" => "Day",
            "yAxisName" => "Steps",
            "bgColor" =>  "#ffffff",
            "showXAxisLine" => "1",
            "axisLineAlpha" =>  "25",
            "divLineAlpha" =>  "10"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
              	"label" => $row["id"],
              	"value" => $row["steps"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("area2d", "myFirstChart" , 1000, 400, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}

  	?>

  	<div id="chart-1"><!-- Fusion Charts will render here--></div>
   </body>

</html>

  
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <br>
    <br>
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