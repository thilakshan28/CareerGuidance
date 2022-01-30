<?php

$con = mysqli_connect('localhost','root','','eventinfo');



$id = $_GET['id']; 



$result = mysqli_query($con, "SELECT *from usertable WHERE id='$id'");
    $row = mysqli_fetch_array($result);
   
      $change=  mysqli_query($con, "UPDATE usertable set password='" . $row["regnumber"] . "' WHERE id='$id'");
        
if($change)
{
    mysqli_close($con); 
    header("location:homeAdmin.php?student"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>