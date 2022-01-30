<?php

session_start();

$con = mysqli_connect('localhost','root','','eventinfo');

$event = $_POST['event'];
$name = $_POST['students'];



    foreach($name as $value)
    {
        $user_explode = explode('|', $value);
        $event_explode = explode('|', $event);

        $s = " select * from certificate where date = '$event_explode[1]' and name= '$user_explode[0]' and regnumber= '$user_explode[1]' and event='$event_explode[0]'";

$result = mysqli_query($con, $s);
$num=0;
if($result){
$num = mysqli_num_rows($result);
}
if($num == 1){
	
}
else{


	$reg= " insert into certificate(date , name , regnumber, event  ) values('$event_explode[1]' , '$user_explode[0]' ,  '$user_explode[1]' ,'$event_explode[0]'  )";
    $result = mysqli_query($con, $reg);
}

    }
	
	echo '<script>alert(" Event has been added successfully!")</script>';
	header("location:homeAdmin.php?certificate"); 
?>