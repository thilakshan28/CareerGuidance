<head>
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/sweetalert/sweetalert.min.js"></script>
</head>
<?php

session_start();


$con = mysqli_connect('localhost','root','','eventinfo');


$username = $_POST['loginUsername']; 
$pass = $_POST['loginPassword'];

$s = " select * from usertable where BINARY regnumber = '$username' AND password = '$pass'  " ;

$result = mysqli_query($con, $s);
if($result){
$num = mysqli_num_rows($result);
}else{
	$num =0;
}
if($num == 1){
	 $_SESSION['username'] = $username; 
	 if($username=='admin'){
		header('location:homeAdmin.php');
	 }else{
		header('location:homeStudent.php');
	 }
	

}
else{
	echo '<script type="text/javascript">
	$(document).ready(function(){

		swal("These credentials do not match our records!","Please Try Again","error").then( () => {
			location.href = "login.html"
		});
		
	});
	</script>';	
}


?>

