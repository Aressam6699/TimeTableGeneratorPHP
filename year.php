<?php
session_start();
if(!isset($_SESSION['user1']))
{
    header('Location: adminlogin.php?id2=1');
}
?>
<html>
<head>
    <title>Academic year</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>
      <ul>
  <li><a href="adminhome.php">Home</a></li>
  <li><a class="active" href="year.php">Year master</a></li>
  <li><a href="course.php">Course master</a></li>
  <li><a href="subject.php">Subject master</a></li>
  <li><a href="teacher.php">Teacher master</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">

    <h1 align="center">Year master </h1>
    <h1>Admin : <?php echo $_SESSION["user1"]; ?></h1>
    <form action="yearINS.php" method="post">
    	<table>
    		<tr>
    			<td>Enter new academic year start date</td>
    			<td><input type="date" name="start"></td>
    		</tr>
    		<tr>
    			<td>Enter new academic year end date</td>
    			<td><input type="date" name="end"></td>
    		</tr>
    		<tr><td><input type="submit" value="Insert"></td></tr>
    	</table>
    </form>

    <br>
    Added:
    <br>
    <?php
		$con=mysqli_connect("localhost","root","aressam1999");
		mysqli_select_db($con,"instmgtsys");
		$q="SELECT * FROM year";
		$res=mysqli_query($con,$q);
	?>
	<table border="1">
		<tr>
			<td>Year start</td>
			<td>Year end</td></tr>
		<?php
			if(mysqli_num_rows($res)) 
			{
				while($row=mysqli_fetch_array($res))
				{
		?>
		<tr><td><?=$row['start']?></td><td><?=$row['end']?></td></tr>
	<?php
}
}
else
	echo "<tr><td>NAN</td><td>NAN</td></tr>";
	?>
	</table>
</div>
</body>
</html>

<script>
	/*$(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy'});
    });

    $(function(){
  $("#data").keypress(function(){
    $("#data2").val($(this).val());
  });
});*/
</script>
