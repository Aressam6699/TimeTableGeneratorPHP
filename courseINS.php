<?php
$shortcname=$_POST['shortcname'];
$cname=$_POST['cname'];
$comp_year=$_POST['comp_year'];
$sem_per_year=$_POST['sem_per_year'];
$con=mysqli_connect('localhost','root','aressam1999');
mysqli_select_db($con,"instmgtsys") or die("2");
$q="INSERT INTO course VALUE(0,'$cname','$shortcname',$comp_year,$sem_per_year)";
mysqli_query($con,$q);

$lastid=mysqli_insert_id($con);
for($i=1;$i<=($comp_year*$sem_per_year);$i++)
{
	$q2="INSERT INTO semester VALUE(0,$lastid,'$shortcname Sem$i')";
	mysqli_query($con,$q2);
}
header('Location: course.php');
?>