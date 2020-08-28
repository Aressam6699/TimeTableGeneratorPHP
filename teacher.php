<html>
<head>
    <title>Adminhome</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
    <ul>
  <li><a href="adminhome.php">Home</a></li>
  <li><a href="department.php">Department</a></li>
  <li><a href="year.php">Year</a></li>
  <li><a href="subject.php">Subject</a></li>
  <li><a class="active" href="teacher.php">Teacher</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classes</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  <br>
<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");

	$q2="SELECT * FROM institute";
	$res2=mysqli_query($con,$q2);
	while($row2=mysqli_fetch_array($res2))
	{
?>
<form action="teacherINS.php" method="POST" name="teacher_form" id="teacher_form">
<table>
<tr>
<td>Enter faculty name</td>
<td><input type="text" name=tname class="tname"><font color="red"><span class='tname-error'></span></td>
</tr>
<tr>
<td>Enter weekly theory load</td>
<td><input type="number" name=thload class="thload"><font color="red"><span class='thload-error'></span></td>
</tr>
<tr>
	<td>Enter weekly laboratory load</td>
	<td><input type="number" name=labload class="labload"><font color="red"><span class='labload-error'></span></td>
</tr>
<tr>
	<td>Status </td>
	<td><input type="radio" name=status value="1" checked>Permenant <br>
		<input type="radio" name=status value="0">Visiting
	</td>

</tr>
<tr>
	<td>Active</td>
	<td><input type="radio" name=active value="1" checked>Yes <br>
		<input type="radio" name=active value="0">No
	</td>

</tr>
<tr>
	<td>Timing available</td>
	<td>
	<table border="2" cellspacing="3" align="center">
	<?php
	$slot='A';
		for($i=1;$i<=$row2['days'];$i++)
		{$k=1;
	?>	

		<tr>
			<?php
				for($j=date('H',strtotime($row2['lecstrt']));$j<date('H',strtotime($row2['lecend']));$j++)
				{$slot2=$slot.$k++;
			?>
			<td><input type="checkbox" name="time[]" checked value="<?=$slot2?>"><?=$slot2?></td>
			<?php
			}
			$slot++;
			?>
		</tr>

	<?php
		}
	?>
	</table>
	</td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="Submit"></td>
</tr>
</table>
</form>
<?php
		}
?>
</div>

</body>
</html> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#subject_form').on('submit', function(event){
        
  var user = $('.tname').val();
  var pass = $('.thload').val();
  var pass = $('.labload').val();

  var tname_f,thload_f,labload_f;
  //alert(iname);
   if(tname == '')
   {
    $(".teacher-error").text("Please enter the teacher name");
    // alert(error);
     tname_f=0;
   }
   if(thload<=0)
   {
	   	$(".thload-error").text("Not a valid load");
    // alert(error);
     	thload_f=0;
   }

	if(labload == 0)
	{
	   $(".labload-error").text("Not a valid load");
	   labload_f=0;
	}   	

   if(tname_f==0 || thload_f==0 || labload_f==0)
   {
    return false;
   }
   else
    return true;

  }); 
});
</script>