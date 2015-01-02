<?php

$dbname = "musicaldb";
$user = "root";
$pass = "";
$host = "localhost";

$con = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($dbname)  or die(mysql_error());

?>