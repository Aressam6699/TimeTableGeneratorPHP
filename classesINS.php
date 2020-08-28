<?php
	session_start();
	if(!isset($_SESSION['user1']))
	{
	    header('Location: adminlogin.php?id2=1');
	}
	$con=mysqli_connect('localhost','root','aressam1999');
	mysqli_select_db($con,"instmgtsys");
	$classid=$_POST['class'];
	$q="SELECT * FROM class WHERE classid=$classid";
	$res=mysqli_query($con,$q);
	$q2="SELECT * FROM institute";
	$res2=mysqli_query($con,$q2);
	while($row2=mysqli_fetch_array($res2))
	{
	while($row=mysqli_fetch_array($res))
	{
?>
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
  <li><a href="teacher.php">Teacher</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a class="active" href="classes.php">Classes</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
	<br>
		<form method="POST" action="classesINS2.php" name="class_form" id="class_form">
			<table>
				<tr>
					<td>Class type</td>
					<td><?=$row['type']?></td>
				</tr>
				<tr><td>Class number</td>
					<td><input type="number" name="roomnumber" class="roomnumber" value="<?=$row['roomno']?>"><font color="red"><span class='roomnumber-error'></span></td>
				</tr>
				<tr><td>Class name</td>
					<td><input type="text" name=classname class="classname" value="<?=$row['classname']?>"><font color="red"><span class='classname-error'></span></td>
				</tr>
				<tr>
					<td>Capacity</td>
					<td><input type="number" name=capacity class="capacity" value="<?=$row['capacity']?>"><font color="red"><span class='capacity-error'></span></td>
				</tr>
				<tr>
					<td>Available time</td>
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
				<tr><td><input type="hidden" name=classtype value="<?=$row['type']?>"><input type="hidden" name=classid value="<?=$classid?>"><input type="submit" value="Submit"></td></tr>
			</table>
		</form>
	</div>
	</body>
</html>

<?php
}}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#class_form').on('submit', function(event){
        
  var roomnumber = $('.roomnumber').val();
  var classname = $('.classname').val();
  var capacity = $('.capacity').val();

  var roomnumber_f,classname_f,capacity_f;
  //alert(iname);
   if(classname == '')
   {
    $(".classname-error").text("Please enter the classname");
    // alert(error);
     classname_f=0;
   }
   if(roomnumber<=0)
   {
	   	$(".roomnumber-error").text("Not a valid room number");
    // alert(error);
     	roomnumber_f=0;
   }

	if(capacity <= 0)
	{
	   $(".capacity-error").text("Not a valid capacity");
	   labload_f=0;
	}   	

   if(classname_f==0 || roomnumber_f==0 || capacity_f==0)
   {
    return false;
   }
   else
    return true;

  }); 
});
</script>