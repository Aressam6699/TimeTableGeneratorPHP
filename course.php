<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con= mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$q="SELECT * FROM course";
	$res=mysqli_query($con,$q);

?>
<html>
<head>
    <title>Course</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
    <ul>
  <li><a href="adminhome.php">Home</a></li>
  <li><a href="year.php">Year master</a></li>
  <li><a class="active" href="course.php">Course master</a></li>
  <li><a href="subject.php">Subject master</a></li>
  <li><a href="teacher.php">Teacher master</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
<br>
<form action="courseINS.php" id="course_form" method="POST">
<table>
<tr>
<td>Course name</td>
<td><input type="text" class="cname" name=cname><font color="red"><span class='cname-error'></span></td>
</tr>
<tr>
<td>Course short name</td>
<td><input type="text" class="shortcname" name=shortcname><font color="red"><span class='shortcname-error'></span></td>
</tr>
<tr>
	<td>Years for completion of course</td>
	<td><input type="number" class="comp_year" name="comp_year"><font color="red"><span class='comp_year-error'></span></td>
</tr>
<tr>
	<td>Number of semester per year</td>
	<td><input type="radio" name="sem_per_year" value=1>1<br>
		<input type="radio" name="sem_per_year" value=2 checked>2</td>
</tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"></td>
</tr>
</table>
</form>

<table>

<tr>
	<td>Course name</td>
	<td>Years for completion</td>
	<td>Semesters per year</td>
</tr>	
<?php

if(mysqli_num_rows($res))
{
	while($row=mysqli_fetch_array($res))
	{
	?>

	<tr>
		<td>
			<?=$row['cname']?>
		</td>
		<td><?=$row['comp_year']?></td>
		<td><?=$row['sem_per_year']?></td>
	</tr>

	<?php
}
}
else
	echo "<tr><td>No</td><td>courses</td><td>added</td</tr>";
?>
</table>
</div>
</body>
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#course_form').on('submit', function(event){
  var cname= $('.cname').val();
  var comp_year= $('.comp_year').val();
  var shortcname = $('.shortcname').val();
  var cname_f,shortcname_f,comp_year_f;
  //alert(iname);
   if(cname == '')
   {
    $(".cname-error").text("Please enter the course name");
    // alert(error);
     cname_f=0;
   }
   if(shortcname == '')
   {
    $(".shortcname-error").text("Please enter the short name");
    // alert(error);
     shortcname_f=0;
   }
   if (comp_year<=0) 
   {
   	$(".comp_year-error").text("Please enter a valid value");
   	comp_year_f=0;
   }
   if(cname_f==0 || shortcname_f==0 || comp_year_f==0)
   {
    return false;
   }
   else
    return true;

  }); 
});
</script>