<?php

session_start();
if(!isset($_SESSION['username'])){
	header('location:login.html');
}
$conn = mysqli_connect("localhost", "root", "", "eventinfo") or die("Connection Error: " . mysqli_error($conn));

if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from usertable WHERE regnumber='" . $_SESSION["username"] . "'");
    $row = mysqli_fetch_array($result);
    $password = $_POST["newPassword"];


$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    $message="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
}else{
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($conn, "UPDATE usertable set password='" . $_POST["newPassword"] . "' WHERE regnumber='" . $_SESSION["username"] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
}
?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" href="css/changPassword.css">
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "Required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "Required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "Required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "Not_Same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>
<div class="home-wrap">
  <div class="home-html">
      <?php
	 if($_SESSION['username']=='admin'){?>
        <a href=homeAdmin.php><button> Go Back</button></a>
	 <?php }else{ ?>
        <a href=homeStudent.php><button>Go Back</button></a>
	<?php }
?>
    <form name="frmChange" method="post" action=""
        onSubmit="return validatePassword()">
        <div style="width: 500px;">
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
            <table border="0" cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Change Password</td>
                </tr>
                <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="password"
                        name="currentPassword" class="txtField" /><span
                        id="currentPassword" class="required"></span></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPassword"
                        class="txtField" /><span id="newPassword"
                        class="required"></span></td>
                </tr>
                <td><label>Confirm Password</label></td>
                <td><input type="password" name="confirmPassword"
                    class="txtField" /><span id="confirmPassword"
                    class="required"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"
                        value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
        </div>
    </form>
</div>
</div>
</body>
</html>