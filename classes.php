<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");

	$q="SELECT * FROM class";
	$res=mysqli_query($con,$q);
?>
<html>
<head>
    <title>Adminhome</title>
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
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a class="active" href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
  <br>
		<form method="POST" action="classesINS.php">
			<table>
				<tr>
					<td>class</td>
					<td><select name=class>
						<?php
							while($row=mysqli_fetch_array($res))
							{
								if($row['capacity']==0 || $row['roomno']==0)
								{
						?>
						<option value="<?=$row['classid']?>"><?=$row['classname']?></option>
						<?php
							}}
						?>
					</select>
				</td>
				</tr>
				<tr><td><input type="submit" value="Submit"></td></tr>
			</table>
			<br>
<br>
<table>
	<tr><td>Classname : </td><td>Class type</td><td>Roomnumber : </td><td>Capacity : </td></tr>
	
		<?php
		$q2="SELECT * FROM class WHERE capacity>0 AND roomno>0";
		$res2=mysqli_query($con,$q2);
		if(mysqli_num_rows($res2))
		{
			while($row2=mysqli_fetch_array($res2))
			{
			?>
		<tr>
			<td><?=$row2['classname']?></td><td><?=$row2['type']?></td><td align="center"><?=$row2['roomno']?></td><td align="center">-</td><td><?=$row2['capacity']?></td>
	</tr>
	
	<?php
		}
	}
	?>
</table>
		</form>
	</div>
	</body>
</html>