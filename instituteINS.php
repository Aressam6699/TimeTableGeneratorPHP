<?php

$iname=$_POST['iname'];
$thclass=$_POST['thclass'];
$labclass=$_POST['labclass'];
$lecdur=$_POST['lecdur'];
$days=$_POST['days'];
$lecstrt=$_POST['lecstrt'];
$lecend=$_POST['lecend'];
$brkstrt=$_POST['brkstrt'];
$brkend=$_POST['brkend'];


session_start();


$con=mysqli_connect('localhost','root','aressam1999');
mysqli_select_db($con,"instmgtsys");

//mysqli_query($con,"TRUNCATE institute");
//mysqli_query($con,"TRUNCATE timing");
$q="INSERT INTO institute VALUE(0,'$iname',$labclass,$thclass,$lecdur,'$lecstrt','$lecend',$days,'$brkstrt','$brkend')";
mysqli_query($con,$q);
$_SESSION["iname"]=$iname;

$lastid=mysqli_insert_id($con);




$slot='A';
for($i=1;$i<=$days;$i++)
{
	$k=1;
	for($j=date('H',strtotime($lecstrt));$j<date('H',strtotime($lecend));$j+=$lecdur)
	{
		$slot2=$slot.$k++;
		$q2="INSERT INTO slot VALUE(0,$lastid,'$slot2','$i')";
		mysqli_query($con,$q2);
	}
	$slot++;
	
}

for($i=1;$i<=$labclass;$i++)
{
	$q3="INSERT INTO class VALUE(0,$lastid,0,'lab$i','lab',0)";
	mysqli_query($con,$q3);
}
for($i=1;$i<=$thclass;$i++)
{
	$q4="INSERT INTO class VALUE(0,$lastid,0,'th$i','theory',0)";
	mysqli_query($con,$q4);
}

header('Location: superadminhome.php?id=1');
?>