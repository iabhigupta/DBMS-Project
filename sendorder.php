<?php

error_reporting(0);
include("dbconnect.php");
####################################################################################

function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}

$key = rand_string(12);

####################################################################################
if(($_POST['name']!="")&&($_POST['email']!="")&&($_POST['phone']!="")&&($_POST['quantity']!="")){

	####### dont edit the code after this line! ###################################
	$subject = 'inquery from my shop site !!!';
	$from = $_POST['email'];
	$name =  $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['phone'];
	$location = $_POST['country'];
	$prodname = $_POST['prodname'];
	$price = $_POST['price'];
	$qty = (int)$_POST['quantity'];
	$stock = (int)$_POST['stock'];
	$productid = $_POST['prid'];
if($qty > $stock || $qty == 0){ 

die("<script>alert('order fail! Quantity Must not be greater than the stocks!!'); location.replace('index.php')</script>");
	}

$total = number_format($price * $qty);
echo "Order was Successfully Send!!
<br><br>
Payment: P$total<br>
Payment Key: $key
<br><br><a href='index.php'>Back to Home</a>";

$query = "insert into transaction_tbl(`key`,`fname`,`email`,`contact`,`location`,`productid`,`productname`,`quantity`,`price`,`stock`,`orderstat`) 
	values('$key','$name','$email','$contact','$location','$productid','$prodname','$qty','$price','$stock','pending')";
$result = mysql_query($query) or die(mysql_error());

//$content = "Name:" . $_POST['name'] ."<br>Email:". $_POST['email'] ."<br>Phone:". $_POST['phone'] .
//"<br>Country:". $_POST['country'] ."<br>Product name:". $_POST['prodname'] ."<br>Price:". $_POST['price'] .
//"<br>Quantity:". $_POST['quantity'];
//mail($to , $subject, $content, "From: $from \n" ."MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1");
	


}
else{
	echo "<script>alert('order fail! message was not complete!')</script>";
	echo "<script>location.replace('index.php')</script>";
}
//echo "<script>location.replace('index.php')</script>";
?>