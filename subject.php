<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con = mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$q="SELECT * FROM semester";
	$res= mysqli_query($con,$q);

	$q2="SELECT	* FROM subject,semester WHERE subject.semid=semester.semid ORDER BY subject.subjectname ASC"; 
	$res2=mysqli_query($con,$q2);
?>
<html>
<head>
    <title>Subject</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
    <ul>
<li><a href="adminhome.php">Home</a></li>
  <!-- <li><a href="department.php">Department</a></li> -->
  <li><a href="year.php">Year master</a></li>
  <li><a href="course.php">Course master</a></li>
  <li><a class="active" href="subject.php">Subject master</a></li>
  <li><a href="teacher.php">Teacher master</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
 <br>
<form action="subjectINS.php" id="subject_form" method="POST">
<table>
	<tr>
		<td>Select course:</td>
		<td>
			<select name="course">
				
			<?php
				while($row=mysqli_fetch_array($res))
			{
			?>
				<option value="<?=$row['semid']?>"><?=$row['semname']?></option>
			<?php
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
<td>Enter subject name</td>
<td><input type="text" class="subject" name=subject><font color="red"><span class='subject-error'></span></td>
</tr>
<tr>
	<td>Select Type</td>
	<td>
		<input type="radio" class="subtype" name=subtype value="lab" onclick="toggleTextbox('lab')"> Lab<br>
		<input type="radio" class="subtype" name=subtype value="theory"  onclick="toggleTextbox('theory')">Theory
	</td>
</tr>
<tr>
<td>Enter theory load</td>
<td><input type="number" value="0" class="thload" name=thload id="thload"><font color="red"><span class='thload-error'></span></td>
</tr>
<tr>
	<td>Enter laboratory load</td>
	<td><input type="number" value="0" class="labload" disabled="true" id="labload" name=labload><font color="red"><span class='labload-error'></span></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="Submit"></td>
</tr>
</table>
</form>
<br>
<br>
<table>
	<tr><td>Subject</td><td>Type : </td><td>Theory load</td><td>Lab load</td><td>Semester</td></tr>
	
		<?php
		if(mysqli_num_rows($res2))
		{
			while($row2=mysqli_fetch_array($res2))
			{
				if ($row2['labload']==0) 
				{
		?>
		<tr>
			<td><?=$row2['subjectname']?></td><td><?=$row2['subtype']?></td><td align="center"><?=$row2['thload']?></td><td align="center">-</td><td><?=$row2['semname']?></td>
	</tr>
	<?php
		}
		else
		{	
	?>
	<tr>
			<td><?=$row2['subjectname']?></td><td><?=$row2['subtype']?></td><td align="center">-</td><td align="center"><?=$row2['labload']?></td><td><?=$row2['semname']?></td>
	</tr>
	<?php
		}}
	}
	?>
</table>
</div>
</body>
</html> 
<script type="text/javascript">
function toggleTextbox(opt)
{
    if (opt == 'theory')
    {
        document.getElementById('labload').disabled = true;
        document.getElementById('thload').disabled = false;
    }
    else
    {
        document.getElementById('thload').disabled = true;
    	document.getElementById('labload').disabled = false;
    }
}
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#subject_form').on('submit', function(event){
        
  var subject = $('.subject').val();
  var subtype =  $("input[name='subtype']:checked").val();
  var thload = $('.thload').val();
  var labload = $('.labload').val();
  alert(subtype);
  var subject_f,thload_f,labload_f;
  //alert(iname);
   if(subject == '')
   {
    $(".subject-error").text("Please enter the subject name");
    // alert(error);
     subject_f=0;
   }
   if(subtype == 'theory')
   {
   	if(thload <= 0)
	{   $(".thload-error").text("Not a valid theory load");
    // alert(error);
     	thload_f=0;
   	}
   }
   else
	{
		if(labload <= 0)
		{
		   $(".labload-error").text("Not a valid lab load");
		 	labload_f=0;
		}
	}   	
   if(subject_f==0 || thload_f==0 || labload_f==0)
   {
    return false;
   }
   else
    return true;

  }); 
});
</script>
