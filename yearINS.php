<?php
	$start=$_POST['start'];
	$end=$_POST['end'];
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"InstMgtSys");
	$q="INSERT INTO year VALUE(0,'$start','$end',0)";
	mysqli_query($con,$q);
	header('Location: year.php');
?>