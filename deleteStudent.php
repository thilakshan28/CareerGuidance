<?php

$con = mysqli_connect('localhost','root','','eventinfo');



$id = $_GET['id']; 

$del = mysqli_query($con,"delete from usertable where id = '$id'"); 

if($del)
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