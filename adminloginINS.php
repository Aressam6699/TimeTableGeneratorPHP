<?php
    session_start();
    $user=$_POST['user'];
    $pass=$_POST['pass'];

    $connection=mysqli_connect('localhost','root','aressam1999');
    mysqli_select_db($connection,"InstMgtSys") or die("2");

    $query="SELECT * FROM login WHERE username='".$user."' AND password='".$pass."' AND type='admin'";
    echo $query;
    $result=mysqli_query($connection,$query) or die(mysql_error());

    if(mysqli_num_rows($result) > 0 )
    {
        session_start();
        $_SESSION["user1"]=$user;
        header('Location: adminhome.php');
    }
    else
    {
        header('Location: adminlogin.php?id=1');
    }

?>
