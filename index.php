<!DOCTYPE HTML>

<html>
	<head>
		<title>Health Dashboard</title>
		<meta http-equiv="Cache-Control" content="no-store" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">
					<div class="container">

						<!-- Logo -->
							<div id="logo">
								<span class="pennant"><span class="icon fa-tint"></span></span>
								<h1><a href="index.php">Health Dashboard</a></h1>
							</div>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="active"><a href="index.php">Home</a></li>
									<li><a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'"> Login</a></li>
									<li><a href="javascript:void(0);" onclick="document.getElementById('id02').style.display='block'">Register</a></li>
									<li><a href="contact.php">Contact</a></li>
								</ul>
							</nav>

					</div>
				</div>


//login

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <img src="images/avatar2.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" action="index.php" method="POST">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="userid" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>
  </div>

<?php  
    include('template.php');
    if(isset($_POST["userid"]) and isset($_POST["password"]))
    {  
        $user = $mysqli->real_escape_string($_POST['userid']);
        $psw = $mysqli->real_escape_string($_POST['password']);
        $query=<<<END
          SELECT userid,password,id FROM register_information WHERE userid = '{$user}' and password = '{$psw}'
END;
        $result=$mysqli->query($query);
        if($result->num_rows>0){
            $row=$result->fetch_object();
            $_SESSION["userid"]=$row->userid;
            $_SESSION["Id"]=$row->id;
            header("Location:loginindex.php");
            // $_SESSION[""]
        }else{
            echo "<script>alert('The username or password you provided is incorrect.Please try again！');</script>";
        }
            }
 ?>



//register
<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <script type="text/javascript">
  function Reset{
  var message=confirm("Do you want to reset?");
  if(message){
      document.getElementById(title).value="";
       }
    }
</script>

      <form class="w3-container" action="register.php" method="POST">
      <table>
        <div class="w3-section">
          <tr>     
        <td width="25%" height="35" align="right">Name</td>
        <td width="75%" class="category">
          <input type="text" style="width:149px" name="firstname" onBlur="return checkrname();" placeholder="   First name">  
          <input type="text" style="width:149px" name="lastname" placeholder="   Last name">
            <font color="#ff0000">*</font>
            <span id="rname1"></span>
        </td>
      </tr>


      <tr>     
        <td align="right" height="35">Username</td>
        <td class="category">
         <input type=text style="width:300px" name="userid" onBlur="return checkUserName();">  
           <font color="#ff0000">*</font>
            <span id="check1"></span>
        </td>
      </tr>


      <tr> 
        <td align="right" height="30">Email</td>
        <td class="category">
         <input type="text" name="email" style="width:300px" name="email" onBlur="return checkEmail();">
         <font color="#ff0000">*</font>
        </td>
      </tr>
      


      <tr>  
        <td align="right" height="35">User password</td>
        <td class="category">
         <input type=password style="width:300px" name="password" onBlur="checkpass();" maxlength=20> 
          <font color="#ff0000">*</font>
          <span id="password2"></span>
        </td>
      </tr>



      <tr>          
        <td align="right" height="35">Confirm password</td>
        <td class="category">
         <input type=Password style="width:300px" name="confpassword" onBlur="checkpass1();" maxlength=20>  
          <font color="#ff0000">*</font>
          <span id="password3"></span>
        </td>
      </tr>
  



      <tr>  
        <td align="right" height="35">Date of birth</td>
        <td class="category">
        <input type="text" name="birthday" style="width:300px" placeholder="   YYYY/MM/DD">
        </td>
      </tr>


      <tr>    
        <td align="right" height="35">Gender</td>
        <td class="category">
         <input type="radio" name="gender" value="1" checked="checked">
          Male
         <input type="radio" name="gender" value="0">
          Female 
        </td>
      </tr> 



      <tr> 
        <td align="right" height="35">Mobile phone number</td>
        <td class="category">
         <input type="text" name="telephone" style="width:300px">
        </td>
      </tr> 


      <tr>  
        <td align="right" height="35">Address</td>
        <td class="category">
         <input type="text" name="address" style="width:300px">
        </td>
      </tr> 
     
      <tr>   
        <td height="35"> </td>
        <td class="category">
           <input type="submit" name="Submit" value="Submit">    
           <input type="reset" value="Reset" onclick="Reset()">   
        </td>
      </tr> 
     </div>  
  </table>
 </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
       <p><span class="error">Fields with asterics* are required</span></p>
        <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

      </div>

    </div>
  </div>



			<!-- Featured -->
				<div id="featured">
					<section class="container">
						<header>
							<h2>Tips'n'tricks</h2>
							<span class="byline">Login for more services like BMI calculator</span>
						</header>
					</section>
				</div>
				
			<!-- Main -->
				<div id="main">
					<section class="containerss">
						<div class="row">
							<section class="4u 12u(mobile)">
								<a href="#" class="image full"><img src="images/pic01.jpg" alt="" /></a>
								<div class="box">
									<h3><a href="index.php">Routines</a></h3>
								</div>
							</section>
							<section class="4u 12u(mobile)">
								<a href="#" class="image full"><img src="images/pic02.jpg" alt="" /></a>
								<div class="box">
									<h3><a href="https://www.amazon.co.uk/s/ref=nb_sb_noss_2/260-7425228-9825708?url=search-alias%3Daps&field-keywords=sport">Shop</a></h3>
								</div>
							</section>
							<section class="4u 12u(mobile)">
								<a href="#" class="image full"><img src="images/pic03.jpg" alt="" /></a>
								<div class="box">
									<h3><a href="http://www.webmd.com/diet/">Diet</a></h3>
								</div>
							</section>
						</div>					
					</section>
				</div>

			<!-- Footer -->
				<div id="footer">
							<section>
								<ul class="icons">
									<li><a href="#" class="icon fa-twitter"><span>Twitter</span></a></li>
									<li><a href="#" class="icon fa-facebook"><span>Facebook</span></a></li>
									<li><a href="#" class="icon fa-google-plus"><span>Google+</span></a></li>
									<li><a href="#" class="icon fa-linkedin"><span>Linkedin</span></a></li>
									<li><a href="#" class="icon fa-pinterest"><span>Pinterest</span></a></li>
								</ul>
							</section>

						<!-- Copyright -->
							<div class="copyright">
								&copy; Health Dashboard | Högskolan Halmstad</a>								
							</div>

					</div>
	</body>
</html>