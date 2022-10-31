<?php 
require_once("includes/config.php");
if(!empty($_POST["Username"])) {
	$email= $_POST["Username"];
	
		$result =mysqli_query($bd, "SELECT Username FROM user WHERE Username='$Username'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Username already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Username available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
