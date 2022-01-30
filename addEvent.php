<?php

session_start();

$con = mysqli_connect('localhost','root','','eventinfo');

$date = $_POST['date'];
$time = $_POST['time'];
$title = $_POST['title']; 
$person = $_POST['person'];

	$reg= " insert into eventtable(date , time ,  title , person ) values('$date' , '$time' ,  '$title' , '$person' )";

	$result = mysqli_query($con, $reg);
	echo '<script>alert(" Event has been added successfully!")</script>';
	header('location:homeAdmin.php');
?>