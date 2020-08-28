<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$q="SELECT teacher.tid,teacher.tname FROM teacher,loadtab WHERE teacher.tid=loadtab.tid AND loadtab.thload<teacher.thload AND loadtab.labload<teacher.labload";
	$res=mysqli_query($con,$q);
?>
<html>
<head>
    <title>Teacher allocation</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
    <ul>
<li><a href="adminhome.php">Home</a></li>
  <!-- <li><a href="department.php">Department</a></li> -->
  <li><a href="year.php">Year master</a></li>
  <li><a href="course.php">Course master</a></li>
  <li><a href="subject.php">Subject master</a></li>
  <li><a href="teacher.php">Teacher master</a></li>
  <li><a class="active" href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  <br>
		<form method="POST" action="allocteacherINS.php">
			<table>
				<tr>
					<td>Select teacher</td>
					<td>
					<select name=teacher>
						<?php
							while($row=mysqli_fetch_array($res))
							{
								?>
							<option value="<?=$row['tid']?>"><?=$row['tname']?></option>
						<?php
							}
						?>
					</select>
				</td>
				</tr>
				<tr><td><input type="submit" value="Submit"></td></tr>
			</table>
		</form>
	</div>
	</body>
</html>