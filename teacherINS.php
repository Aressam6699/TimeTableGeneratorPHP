<?php
	$tname=$_POST["tname"];
	$thload=$_POST["thload"];
	$labload=$_POST["labload"];
	$tname=$_POST["tname"];
	$status=$_POST["status"];
	$active=$_POST["active"];
	$time=$_POST["time"];
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$q="INSERT INTO teacher VALUE(0,'$tname',$status,$thload,$labload,$active)";
	mysqli_query($con,$q);
	echo "ok";	

	$lastid=mysqli_insert_id($con);

	$q2="INSERT INTO loadtab VALUE($lastid,0,0)";
	mysqli_query($con,$q2);

	/*
	$q3="INSERT INTO loadtab VALUE($lastid,'theory',0)";
	mysqli_query($con,$q3);
	$q4="INSERT INTO loadtab VALUE($lastid,'lab',0)";
	mysqli_query($con,$q4);
	*/
	foreach($time as $a)
		{
			$q2="INSERT INTO teacher_time VALUE($lastid,'$a')";
			mysqli_query($con,$q2);
		}	
		
	$q3="INSERT INTO loadtab VALUE($lastid,0,0)";

	header('Location: teacher.php');
?>