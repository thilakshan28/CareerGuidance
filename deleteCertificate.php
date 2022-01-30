<?php

$con = mysqli_connect('localhost','root','','eventinfo');



$id = $_GET['id']; 

$del = mysqli_query($con,"delete from certificate where id = '$id'"); 

if($del)
{
    mysqli_close($con); 
    header("location:homeAdmin.php?certificate"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>