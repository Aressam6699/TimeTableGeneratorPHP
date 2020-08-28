<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: superadminlogin.php?id2=1');
}
?>
<html>
<head>
    <title>Institute details</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
    <ul>
  <li><a href="superadminhome.php">Home</a></li>
  <li><a class="active" href="institute.php">Give institute details</a></li>
  <li><a href="addadmin.php">Add admins</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
		SuperAdmin: <?=$_SESSION['user']?><br>

		<form action="instituteINS.php" method="POST" id="institute_form">
	<table>
	<tr>
	<td>Enter name of the institute</td>
	<td><input type="text" class="iname" name=iname><font color="red"><span class='iname-error'></span></font></td>
	</tr>
	<tr>
	<td>Enter number of theory classrooms available in the institute</td>
	<td><input type="number" class="thclass" name=thclass><font color="red"><span class='thclass-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter number of laboratory classrooms available in the institute</td>
		<td><input type="number" class="labclass" name=labclass><font color="red"><span class='labclass-error'></span></font></td>
	</tr>

	<tr>
		<td>Enter duration of a lecture</td>
		<td><input type="number" class="lecdur" name=lecdur><font color="red"><span class='lecdur-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter number of instructional days in a week</td>
		<td><input type="number" name=days class="days"><font color="red"><span class='days-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter daily lecture start time</td>
		<td><input type="time" name=lecstrt class="lecstrt"><font color="red"><span class='lecstrt-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter daily lecture end time</td>
		<td><input type="time" name=lecend class="lecend"><font color="red"><span class='lecend-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter daily break start time</td>
		<td><input type="time" name=brkstrt class="brkstrt"><font color="red"><span class='brkstrt-error'></span></font></td>
	</tr>
	<tr>
		<td>Enter daily break end time</td>
		<td><input type="time" name=brkend class="brkend"><font color="red"><span class='brkend-error'></span></font></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Submit" id="submit"></td>
	</tr>
	<tr><td><a href="addadmin.php">Add admins</a></td></tr>
	<tr><td><a href="logoutINS.php">Logout</a></td></tr>
	</table>
	</form>

</div>
</body>
</html>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$('#institute_form').on('submit', function(event){
		
  var iname = $('.iname').val();
  var thclass = $('.thclass').val();
  var labclass = $('.labclass').val();
  var lecdur = $('.lecdur').val();
  var days = $('.days').val();
  var lecstrt = $('.lecstrt').val();
  var lecend = $('.lecend').val();
  var brkstrt = $('.brkstrt').val();
  var brkend = $('.brkend').val();

  var iname_f,thclass_f,labclass_f,lecdur_f,days_f,lecstrt_f,lecend_f,brkstrt_f,brkend_f;
  //alert(iname);
   if(iname == '')
   {
    $(".iname-error").text("Please enter the institute name");
    // alert(error);
     iname_f=0;
   }
   if(thclass <= 0)
   {
    $(".thclass-error").text("Please enter valid number of classrooms");
    // alert(error);
     thclass_f=0;
   }
   if(labclass <= 0)
   {
    $(".labclass-error").text("Please enter valid number of classrooms");
    // alert(error);
     labclass_f=0;
   }
   if(lecdur <= 0)
   {
    $(".lecdur-error").text("Please enter valid data");
    // alert(error);
     lecdur_f=0;
   }
   if(days <= 4 || days>7)
   {
    $(".days-error").text("Please enter between 5 and 7");
    // alert(error);
     days_f=0;
   }
   if(brkstrt<lecstrt || brkend>lecend)
   {
    $(".brkstrt-error").text("Please enter a valid timing");
    $(".brkend-error").text("Please enter a valid timing");
    // alert(error);
     brkstrt_f=0;
     brkend_f=0;
   }

   if(iname_f==0 || thclass_f==0 || labclass_f==0 || lecdur_f==0 || days_f==0 || lecstrt_f==0 || lecend_f==0 || brkstrt_f==0 ||brkend_f==0)
   {
   	return false;
   }
   else
   	return true;

  }); 
});
</script>
