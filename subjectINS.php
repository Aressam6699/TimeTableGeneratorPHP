<?php
	$subject=$_POST['subject'];
	$subtype=$_POST['subtype'];
	$thload=$_POST['thload'];
	$labload=$_POST['labload'];	
	$semid=$_POST['course'];
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	if($thload)
	{
		$q="INSERT INTO subject VALUE(0,'$subject','$subtype',$thload,0,$semid)";
		mysqli_query($con,$q);
	}
	else
	{
		$q="INSERT INTO subject VALUE(0,'$subject','$subtype',0,$labload,$semid)";
		mysqli_query($con,$q);	
	}
	echo $q;
	header('Location: subject.php');
?>