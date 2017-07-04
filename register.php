<?php  
   include('template.php');
   if(isset($_POST["Submit"]) && $_POST["Submit"] == "Submit")  
    { 
    	$firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
         $user = $_POST["userid"];  
        $psw = $_POST["password"];
        $psw_confirm = $_POST["confpassword"];
        $email=$_POST["email"];
       if($firstname == "" || $lastname == "" || $user == "" || $psw == "" || $psw_confirm == ""|| $email==""){
       	echo "<script>alert('Please Confirm the information complete！'); history.go(-1);</script>"; 
       }else{
       	if($psw == $psw_confirm){
       		if(!$mysqli){
       			 die("Connection failed:".mysqli_connect_error());
       		}
       		$sql = "SELECT userid FROM register_information WHERE userid = '$_POST[userid]'"; 
       		$result = mysqli_query($mysqli,$sql);     
                $num = mysqli_num_rows($result); 
                if($num)      
                {  
                    echo "<script>alert('User already exist'); history.go(-1);</script>";  
                } else{
                      $query=<<<END
                        INSERT INTO register_information(firstname,lastname,userid,password,gender,birthday,telephone,address,email) VALUES('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['userid']}','{$_POST['password']}','{$_POST['gender']}','{$_POST['birthday']}','{$_POST['telephone']}','{$_POST['address']}','{$_POST['email']}')
END;
if($mysqli->query($query)==true){  
  echo "<script>alert('Register successfully！'); history.go(-1);</script>";
}else{  
 echo "<script>alert('Could not query database'); history.go(-1);</script>";  
}  
                }
       	}else{
       		echo "<script>alert('Password is different,please try again!'); history.go(-1);</script>"; 
       	}
       }

} else {  
        echo "<script>alert('Register failed！'); history.go(-1);</script>";  
    }  
?> 