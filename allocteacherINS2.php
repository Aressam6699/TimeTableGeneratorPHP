<?php

	$tid=$_POST['hid'];
	$subid=$_POST['subject'];
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$thload_total=0;
	$labload_total=0;
	echo "ok";
/*
	$temp=array();
	foreach ($subid as $a) 
	{
		$temp['']=$a;
		
	}
*/

	foreach ($subid as $a)
	{
		echo "<br>".$a;
	}
	echo "<br>";
	foreach ($subid as $a) {
		$q="SELECT thload FROM subject WHERE subjectid=$a";
		$res=mysqli_query($con,$q);
		while($row=mysqli_fetch_array($res))
			$thload_total += $row['thload'];	

	}
	
	foreach ($subid as $a) {
		$q="SELECT labload FROM subject WHERE subjectid=$a";
		$res=mysqli_query($con,$q);
		while($row=mysqli_fetch_array($res))
			$labload_total += $row['labload'];	

	}

	// $q4="UPDATE loadtab SET thload=$thload_total AND labload=$labload_total WHERE tid=$tid";


	$q3="SELECT * FROM teacher,loadtab WHERE loadtab.tid=teacher.tid AND teacher.tid=$tid AND ((loadtab.thload+$thload_total) < teacher.thload) AND ((loadtab.labload+$labload_total) < teacher.labload)";
	$res3=mysqli_query($con,$q3);
	echo "<br>";
	echo $q3;
	if(mysqli_num_rows($res3))
	{
		print_r($subid);
		foreach ($subid as $a) {
			$q4="INSERT INTO teacher_subject VALUE($tid,$a)";
			mysqli_query($con,$q4);
			echo "<br>";
			echo $q4;
		}
		$q5="UPDATE loadtab SET loadtab.thload=(loadtab.thload+$thload_total), loadtab.labload=loadtab.labload+$labload_total WHERE tid=$tid";
		echo $q5;	
				mysqli_query($con,$q5);
	}
 // header('Location: allocteacher.php');
?>