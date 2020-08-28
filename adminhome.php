<?php
session_start();
if(!isset($_SESSION['user1']))
{
    header('Location: adminlogin.php?id2=1');
}
?>
<html>
<head>
    <title>Adminhome</title>
    <link href="csspage.css" rel="StyleSheet" type="text/css">
</head>
<body>

    <ul>
<li><a class="active" href="adminhome.php">Home</a></li>
  <!-- <li><a href="department.php">Department</a></li> -->
  <li><a href="year.php">Year master</a></li>
  <li><a href="course.php">Course master</a></li>
  <li><a href="subject.php">Subject master</a></li>
  <li><a href="teacher.php">Teacher master</a></li>
  <li><a href="allocteacher.php">Allocate subjects to teacher</a></li>
  <li><a href="classes.php">Classroom master</a></li>
</ul>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
    <h1 align="center">Admin home </h1>
    <h1>Admin : <?php echo $_SESSION["user1"]; ?></h1>
 <ul class="customul">
  <li><a href="changeusername.php">Change username</a></li>
  <li><a href="changepassword.php">Change password</a></li>
</ul>
</div>
</body>
</html>