<?php

session_start();
if(!isset($_SESSION['username'])){
	header('location:login.html');
}
?> 

<!DOCTYPE html>
<html>
<head>
	<title> Home Page</title>
	<link rel="stylesheet" href="css/profileStudent.css">
</head>
<body>
<div class="home-wrap">
  <div class="home-html">
<div class="back"><a href=homeStudent.php><button>Back</button></a></div>
<br>

    <div class="home-form">

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "eventinfo";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM usertable where regnumber='".$_SESSION['username']."'";
            $result = $conn->query($sql);

            if ($result!==false && $result->num_rows > 0) {
              $row = $result->fetch_assoc();
            echo "<table><tr><th></th><th></th></tr>";
                echo "<tr><td>Full Name</td><td>".$row["fullname"]."</td></tr>";
                echo "<tr><td>Registration Number</td><td>".$row["regnumber"]."</td></tr>";
                echo "<tr><td>E-mail</td><td>".$row["email"]."</td></tr>";
                echo "<tr><td>Contact Number</td><td>".$row["contact"]."</td></tr>";
            echo "</table><br><hr><br>";

            echo"<button><a href=changePassword.php>Change Password</a></button>";
            } else {
           
            echo "0 results";
            }
            $conn->close();
            ?> 

        <div class="hr"></div>



 


    </div>
  </div>
</div>
</body>
</html>
