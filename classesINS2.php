<?php
	$classtype=$_POST['classtype'];
	$classid=$_POST['classid'];
	$classnumber=$_POST['roomnumber'];
	$classname=$_POST['classname'];
	$capacity=$_POST['capacity'];
	$time=$_POST['time'];
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$q="UPDATE class SET roomno=$classnumber,classname='$classname',capacity=$capacity WHERE classid=$classid";
	mysqli_query($con,$q);
	foreach($time as $a)
		{
			$q2="INSERT INTO class_time VALUE($classid,'$a','$classtype')";
			mysqli_query($con,$q2);
		}
		header('Location: classes.php');
?>