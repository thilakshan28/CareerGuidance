<!DOCTYPE html>
<html>
<head>
	<title> Confirmation Page </title>
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/sweetalert/sweetalert.min.js"></script>

	<?php

session_start();

$con = mysqli_connect('localhost','root','','eventinfo');

$fullname = $_POST['fullname'];
$regnumber = $_POST['regnumber'];
$email = $_POST['email']; 
$contact = $_POST['contact'];
$pass = $_POST['password'];
$conpass= $_POST['confirm-password'];


if($pass==$conpass)
{
$s = " select * from usertable where regnumber = '$regnumber'";

$result = mysqli_query($con, $s);
$num=0;
if($result){
$num = mysqli_num_rows($result);
}
if($num == 1){
	echo '<script type="text/javascript">
	$(document).ready(function(){

		swal("Username already exists!","Please Try Again","warning").then( () => {
			location.href = "signup.html"
		});
		
	});
	</script>';
}
else{
$regnum = preg_match('/[0-9][0-9][A-Z][A-Z][0-9][0-9]/i',$regnumber);
$password = $_POST['password'];


$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
	echo '<script type="text/javascript">
	$(document).ready(function(){

		swal("Password Not Match,"Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.","warning").then( () => {
			location.href = "signup.html"
		});
		
	});
	</script>';
}else if(!$regnum){
	echo '<script type="text/javascript">
	$(document).ready(function(){

		swal("Invalid Registration Number","Please Provide valid Registration Number","warning").then( () => {
			location.href = "signup.html"
		});

	});
	</script>';
}else{
	$reg= " insert into usertable(fullname , regnumber ,  email , contact , password) values('$fullname' , '$regnumber' ,  '$email' , '$contact' , '$pass')";

	if(mysqli_query($con,$reg)){

		echo '<script type="text/javascript">
		$(document).ready(function(){

		swal(" The Registration is Successful!","Go To The Login Page And Login Again","success").then( () => {
			location.href = "logout.php"
		});
		
		});
		</script>';	

	}else {

		echo '<script type="text/javascript">
		$(document).ready(function(){

		swal("Regestration Unsucessfull!","Please Check Your Email and Full Name Fields","warning").then( () => {
			location.href = "signup.html"
		});
		
		});
		</script>';	
		}
}
}
}
else{
	echo '<script type="text/javascript">
		$(document).ready(function(){

		swal("Passwords do not matching!","","warning").then( () => {
			location.href = "signup.html"
		});
		
		});
		</script>';
}
?>
</head>
<body>
</body>
</html>

