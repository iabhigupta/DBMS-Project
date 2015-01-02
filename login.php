<?php //setcookie("user","",time()-3600);?>
<?php 
error_reporting(0);
session_start();

$action = $_REQUEST["action"];
if($action=="logout") { session_destroy(); header("Location: index.php"); }


?>
<div style='border: 1px solid black; margin: auto; width: 300px;'>
Admin Area<br><br>
<form action='login.php' method='post'>
	<center>Username<br>
	<input type=text name=username><br>
	Password<br>
	<input type=password name=password><br>
	<input type=submit name=submit value=submit><br>
	<input type=hidden name='doit' value=yes>
</form>


<?php
if($_POST['doit']=='yes'){

	######################################################################
	///////////// here you can change your password/username //////////////
	$ma_user = "admin"; //your username
	$ma_pass = "admin"; //your password

////////////////////////////////////////////////////////////////////////

if(($_POST['username']==$ma_user)&&($_POST['password']==$ma_pass))
{
	$_SESSION['username']	=	$ma_user;
	$_SESSION['password']	=	$ma_pass;
	$_SESSION['hasacces']	=	'yes';

	echo "<script>location.replace('admin.php')</script>";
}
else
	{echo "Login Error! Username or Password are not match! Try again!";exit;}
}

?>

