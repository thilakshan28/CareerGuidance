<?php

$con = mysqli_connect('localhost','root','','eventinfo');



$id = $_GET['id']; 

$del = mysqli_query($con,"delete from eventtable where id = '$id'"); 

if($del)
{
    mysqli_close($con); 
    header("location:homeAdmin.php"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>