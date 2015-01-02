<?php
error_reporting(0);
$ma_pass=$_GET['ma_pass'];
$action=$_GET['action'];
//$datecookie = date("d");
$usercookie = $ma_pass;


if($action=="login"){
	setcookie("user","$usercookie",time()+3600);
	echo "<script>location.replace('admin.php')</script>";
}

if($action=="logout"){
	//setcookie("user","",time()-3600);
	
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['hasacces']);
	echo "<script>location.replace('login.php')</script>";
}
?>