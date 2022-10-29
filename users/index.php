<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($bd, "SELECT * FROM user WHERE Username='".$_POST['Username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="complaint-details.php";// i had to change this from change password to complaint histroy so that when logging on the complaint history is the first page a user will see


$_SESSION['login']=$_POST['Username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($bd, "insert into userlog(uid,Username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['Username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($bd, "insert into userlog(Username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid Username or password";
$extra="login.php";

}
}
// stuff login 
if(isset($_POST['staff']))
{
$ret=mysqli_query($bd, "SELECT * FROM staff WHERE Username='".$_POST['Username']."', password='"($_POST['password'])."' and roles='staff' ");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="complaint-history.php";// i had to change this from change password to complaint histroy so that when logging on the complaint history is the first page a user will see



}
}



//stuff login end



if(isset($_POST['change']))
{
   $Username=$_POST['Username'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM user WHERE Username='$Username' and contactNo='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($bd, "update user set password='$password' WHERE Username='$Username' and contactNo='$contact' ");
$msg="Password Changed Successfully";

}
else
{
$errormsg="Invalid  Username or Contact no";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>HRMS | User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">STUDENT AND STAFF LOGIN</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="Username" placeholder="Username"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
					<i  style="position:absolute; right:20px; top:20%; cursor:pointer; font-size:20px; color:blue;" class="las la-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <!--<button name="staff">Staff</button> -->
		
		                </span>
						<div class="Studentlogin">
		                <!--<button class="" name ="submit">
		                    Student
		                </button> -->
		            </div>
		            </label>
		          <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
					
				</form>
		            <div class="registration">
		               <!-- Don't have an account yet?<br/>-->
		                <a class="" href="registration.php">
		                    Create an account </a>
							<a class=""href="change-password.php"> <br> Forgot password  </br></a>
		                
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		           <form class="form-login" name="forgot" method="post">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your details below to reset your password.</p>
<input type="Username" name="Username" placeholder="Username" autocomplete="off" class="form-control" required><br >
<input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >

		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>
		
		      	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>
<!--the script for showing the password isnt working -->
<script> 
	const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById('id_password');
	console.log(password.value);
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.type;
	console.log(type)
	if (type === 'password') 
	{
		password.type  = "text";
	} 
	else{
		password.type = 'password';
	}/* === 'password' ? 'text' : 'password'; */
    // password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('la-eye-slash');
});
</script> 

  </body>
</html>
