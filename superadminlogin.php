<?php
opcache_reset();
?>
<html>
    <head>
  
        <title>Login</title>
        <link href="csspage.css" rel="StyleSheet" type="text/css">
    </head>
    <body>
        <h1 align="center">Super admin Login</h1>
        <form action="superadminloginINS.php" name="login_form" id="login_form" method="post">
            <table class="">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name=user><font color="red"><span class='user-error'></span></font></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name=pass><font color="red"><span class='pass-error'></span></font></td>
                </tr>
                <tr><td><input type="submit" value="Log-in"></td></tr>
            </table>
        </form>
              <br>
                <br>
                <?php
            if(intval($_GET['id'])!=null)
            {
                ?>
            
            <font color="red">
            Login fail. <br> Enter correct credentials
            </font>           
            <?php
            }
            if(intval($_GET['id2'])!=null)
            {
            	?>

            	<font color="red">
            		<br>
            	Cannot view page without logging in
            	</font>

            	<?php
            }
        ?>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$('#login_form').on('submit', function(event){
		
  var user = $('.user').val();
  var pass = $('.pass').val();

  var user_f,pass_f;
  //alert(iname);
   if(user == '')
   {
    $(".user-error").text("Please enter the user name");
    // alert(error);
     user_f=0;
   }
   if(pass == '')
   {
    $(".pass-error").text("Please enter the password");
    // alert(error);
     pass_f=0;
   }
   if(user_f==0 || pass_f==0)
   {
   	return false;
   }
   else
   	return true;

  }); 
});
</script>
