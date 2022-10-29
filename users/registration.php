<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$Username=$_POST['Username'];
	$password=md5($_POST['password']);
	$contactno=$_POST['contactno'];
	$status=1;
	$roles=$_POST['contactno'];
	
	$query=mysqli_query($bd, "insert into user(fullname,Username,password,contactNo,status,roles) values('$fullname','$Username','$password','$contactno','$status','$roles')");
	$msg="Registration successfull. Now You can login !";
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

    <title>HRMS | User Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" rel="stylesheet">
	
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'Username='+$("#Username").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" method="post">
		        <h2 class="form-login-heading">User Registration</h2>
		        <p style="padding-left: 1%; color: green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?>


		        </p>
		        <div class="login-wrap">
		         <input type="text" class="form-control" placeholder="Full Name" name="fullname" required="required" autofocus>
		            <br>
		            <input type="text" class="form-control" placeholder="Username" id="Username" onBlur="userAvailability()" name="Username" required="required">
		             <span id="user-availability-status1" style="font-size:12px;"></span>
		            <br>
					<div style="position:relative">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password" id="id_password"><br >
					<i  style="position:absolute; right:20px; top:20%; cursor:pointer; font-size:20px; color:blue;" class="las la-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
					</div>
		            <div>
					<input type="text" class="form-control" maxlength="10" name="contactno" placeholder="Contact no" required="required" autofocus>
					</div>
					
								<!--			
										<select name="role" class="form-control" required="">
                <option value=""> Role</option> 
				<option value="Student">Student</option> 
				

                  <option value="Maintenancemanger">Maintenace manager</option> 
                  <option value="Maintnenaceemployee">Maintenace Employee</option>    
                </select> 
				<br>
				<div>
<label for="role">role</label>

<select name="role" id="role"> -->
    <!--<option value="">role</option>
    <option value="Student">Student</option>
    <option value="Maintenacemanager">Maintenace Manager</option>
    <option value="MaintenaceEmployee">Maintenace Employee</option>
    
</select>

					</div> -->
		            <br>
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
		            <hr>
		            <div class="registration">
		                Already Registered<br/>
		                <a class="" href="index.php">
		                   Sign in
		                </a>
		            </div>
		
		        </div>
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
