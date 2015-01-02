<?php

error_reporting(0);
session_start();
include("dbconnect.php");

$stockrep = 5;


$username = $_SESSION['username'];

	if(empty($username)){
		die("error 467. bad login! <a href='login.php'>login here</a>");
		
	}

$action = $_REQUEST['action'];

?>

<style>
td { font-size:11px; font-family:verdana; vertical-align:top; background: #EEEEEE; color: #333333; padding: 5px; }
input,select{ font-size:11px;font-family:verdana; }
td:hover{ background: #DDDDDD; color: #FF0000; }
th { background: #007700; color: #eee; font-family: verdana; font-size: 11px;}
a, a:visited { color: #0174d9; text-decoration: none; }
a:hover { text-decoration: underline; }
.a, .a:visited { color: #101010;  text-decoration: none;}
.a:hover { background: #eee; text-decoration: none; }
</style>
<title>ADMIN PANEL</title>
<table border='0' width=700 align='center' cellpadding='2' cellspacing='2' bgcolor='#EEEEEE'><tr><td>
<B>administration area</B> <BR><BR>
| <A HREF="admin.php"><B>Home</B></A>
| <A HREF="admin.php?action=showall"><B>Products</B></A>
| <A HREF="admin.php?action=addnew"><B>Add</B></A>
| <A HREF="admin.php?action=viewpaid"><B>Transactions</B></A>
| <A HREF="admin.php?action=validate"><B>Validate Key</B></A>
| <A HREF="admin.php?action=strep"><B>Stock Report</B></A>
| <A HREF="admin.php?action=stockeval"><B>Stock evaluation</B></A>
| <A HREF="login.php?action=logout"><B>Logout </B></A>
</td></tr></table>
<BR><BR>

<?php

if($action=="insert"){
	
	if ($_FILES['logo']['name'] != "") { 
		
		$imageInfo = getimagesize($_FILES['logo']['tmp_name']); // get image size
		$width = $imageInfo[0]; // image width
		$height = $imageInfo[1];  // image height

		if($height > 2000 || $width > 2000){
			echo "<script> alert('Image is to big! Try to resize the picture!') </script>";
			exit;
		} // check size 

		$newimg1 = date("YmdHis").".jpg";  // set name for new image
		$newimg2 = date("YmdHis").".pdf"; // set name for pdf if is necesary

		if(stristr($_SERVER['OS'],"win")){
			$path = "prodimg/";
		} // determin path of image folder
		elseif(stristr($_SERVER['OS'],"linux")){
			$path = str_replace("admin.php","",$_SERVER['SCRIPT_FILENAME']) . "prodimg/";
		} 
		else {
			$path = "prodimg/";
		}

		move_uploaded_file ( $_FILES['logo']['tmp_name'], $path . $newimg1  );
	}  // copy image in image folder
	else{
		$newimg1="pc.gif"; 
	} // if is not posible than set image name as pc.gif

	$cat = $_POST['cat'];
	$price = $_POST['price'];
	$prodname =  $_POST['prodname'];
	$desc = $_POST['descr'];
	$stock = $_POST['stock'];
	$res = mysql_query("insert into item_tbl(catid,itemname,description,cost,stock,picture) 
		values('$cat','$prodname','$desc','$price','$stock','$newimg1')");

	echo "<script>location.replace('admin.php?action=showall')</script>";
}

elseif($action=="delete"){  // start of delete action
		$id = $_GET['id'];
		mysql_query("delete from item_tbl where itemid='$id'");
			echo "<script>alert('product $id has been deleted')</script>";
			echo "<script>location.replace('admin.php?action=showall')</script>";
			
	} // end of delete action

elseif($action=="editprodnow"){
	
	$cat = $_GET['cat'];
	$prodname = $_GET['prodname'];
	$stock = $_GET['stock'];
	$price = $_GET['price'];
	$descr =	stripslashes($_GET['descr']);
	$descr = str_replace("\'", "'", $descr);
	$descr = str_replace('\"', '"', $descr);

	$id = $_GET['id'];
	
		mysql_query("update item_tbl set catid='$cat', description='$descr', itemname='$prodname', stock='$stock',cost='$price' where itemid='$id'");
		echo "<script>alert('product $id has been edited')</script>";
		echo "<script>location.replace('admin.php?action=showall')</script>";
}

elseif($action=="showall"){
		$res = mysql_query("select * from item_tbl");
		$row = mysql_num_rows($res);
		
		echo "<table bgcolor='#000000' border='0' width=700 align='center' cellpadding='1' cellspacing='1'>";
		for($i=0;$i<$row;$i++){
			$itemid  = mysql_result($res,$i,"itemid");
			$itemname = mysql_result($res,$i,"itemname");
			$cost =  mysql_result($res,$i,"cost");
			$stock =  mysql_result($res,$i,"stock");
			$picture =  mysql_result($res,$i,"picture");
			$description = mysql_result($res,$i,"description");

			if($i%2){$bgcolor = "#FFFFFF";} else {$bgcolor = "#DDDDDD";}

			
			echo "
			<tr>
			<td width=150><B>Title:</B>$itemname<B> <BR>Price: </B>$cost<B><BR>Stocks: $stock</B><BR></td>
			<td width=50> <A HREF='admin.php?id=$itemid&action=editprod'>edit</A>  <BR>
			<A HREF='admin.php?id=$itemid&action=delete'>delete</A><BR>
			<A HREF='prodshow.php?id=$itemid' target='_new'>view</A></td>
			<td  width=50> <img src='prodimg/$picture' width=50 height=40>  </td><td> Info:</B> $description</td>
			</tr>"; 
			
		}
	echo "</table><BR>";
	}

elseif($action=="addnew"){
		echo "<CENTER><form action='admin.php' method='post' enctype='multipart/form-data'>";
		echo "<select name=cat><option value='' selected> - Select one category -";

				$res = mysql_query("select * from category_tbl");
				$row = mysql_num_rows($res);
				for($i=0;$i<$row;$i++){
				echo "<option value='".mysql_result($res,$i,"catid")."'> ".mysql_result($res,$i,"description");
			}

		echo "</select><BR>";
		echo "<table>";
		echo "<tr><td> prod. name: </td><td><input type=text name=prodname size=30></td></tr>";
		echo "<tr><td> price: </td><td><input type=text name=price size=30 ></td></tr>";
		echo "<tr><td> Stock: </td><td><input type=text name=stock size=30 ></td></tr>";
		echo "<tr><td> description: </td><td><textarea name=descr cols=30 rows=7></textarea></td></tr>";
		echo "<tr><td> prod. image: </td><td><input type=file name=logo size=20></td></tr>";
		echo "<tr><td> </td><td><input type=submit name=submit value='add product'></td></tr>";
		echo "<tr><td> </td><td><input type=hidden name=action value=insert></td></tr>";
		echo "<tr><td></td><td></form></td></tr>";
		echo "</table>";
	}

elseif($action=="editprod"){
	echo "<CENTER><form action='admin.php' method='get'>";
		$id = $_GET["id"];
		$res = mysql_query("select * from item_tbl where itemid='$id'");
		$res2 = mysql_query("select * from category_tbl");

		$cid = mysql_result($res,0,"catid");
		$name = mysql_result($res,0,"itemname");
		$desc = mysql_result($res,0,"description");
		$cost = mysql_result($res,0,"cost");
		$stock = mysql_result($res,0,"stock");
	
	echo "<table><tr><td>";
	echo "category: <select name=cat>";

	for($x=0;$x<mysql_num_rows($res2);$x++)
	{

		$catid = mysql_result($res2,$x,"catid");
		$category = mysql_result($res2,$x,"description");
		if($cid==$catid) { echo "<option value='$catid' selected>$category"; }
		else { echo "<option value='$catid'>$category"; }
	}


	echo "</select><BR>";
	echo "product name: <input type=text name=prodname size=30 value='$name'><BR>";
	echo "price: <input type=text name=price size=30 value='$cost'><BR>";
	echo "stock: <input type=text name=stock size=30 value='$stock'><BR>";
	echo "description: <textarea name=descr cols=30 rows=7>$desc</textarea><BR>";
	echo "<input type=submit name=submit value='change product info now'><BR>";
	echo "<input type=hidden name=action value=editprodnow><BR>";
	echo "<input type=hidden name=id value='".$id."'><BR>";
	echo "</form></CENTER>";
	echo "</td></tr></table>";
}

elseif($action=="validate"){
	echo "<div style='width:700px; margin:auto;'>";
	echo "	<form action='admin.php' method='get'>
		<input type='hidden' name='action' value='validate2'>
		<b>Enter KEY</b><br>
		<input type='text' name='key' size='30'>
		<input type='submit' value='Validate'>
		</form>";

}

elseif($action=="viewtr"){
	$tid = $_GET['tid'];
	$query = "select * from `transaction_tbl` where `tid`='$tid'";
	$result = mysql_query($query) or die(mysql_error());
	$prid = mysql_result($result,0,"productid");
	$curstock = mysql_result(mysql_query("select * from item_tbl where itemid='$prid'"),0,"stock");

	$name = mysql_result($result,0,"fname");
	$prodname = mysql_result($result,0,"productname");
	$contact = mysql_result($result,0,"contact");
	$stock = mysql_result($result,0,"stock");
	$qty = (int)mysql_result($result,0,"quantity");
	$trno = mysql_result($result,0,"key");
	$email = mysql_result($result,0,"email");
	$tid = mysql_result($result,0,"tid");
	$cost = (int)mysql_result($result,0,"price");
	$price = number_format($qty * $cost);
	$stat = mysql_result($result,0,"orderstat");
	$cost = number_format($cost);
	echo "<div style='width:700px; margin:auto;'>";

	echo "Product name: $prodname<br>
		Cost: P$cost <br>
		Stocks: $curstock <br><br>
		Customer: $name<br>
		Ordered: $qty<br>
		Contact: $contact<br>
		Email: $email<br>
		Amount to paid: P$price <br><br>
		<a href='admin.php?action=validate2&key=$trno'>Validate</a>";

}



elseif($action=="validate2"){
	echo "<div style='width:700px; margin:auto;'>";
	

$key = $_GET['key'];
$query = "select * from `transaction_tbl` where `key`='$key' and `orderstat`='pending'";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_num_rows($result);
$prid = mysql_result($result,0,"productid");
$qty =  (int)mysql_result($result,0,"quantity");

$oldstock = mysql_result(mysql_query("select * from item_tbl where itemid='$prid'"),0,"stock");
$newstock = $oldstock - $qty;

if($qty > (int)$oldstock) { die("<script>alert('Out of Stocks !!'); location.replace('admin.php');</script>");}

if($row>0){ 	
$query = "update `transaction_tbl` set `orderstat`='paid', `stock`='$newstock' where `key`='$key'";
$result = mysql_query($query) or die(mysql_error());
mysql_query("update item_tbl set stock = '$newstock' where itemid='$prid'");

echo "<script>alert('Validated Successfully!!')</script>";
	echo "<script>location.replace('admin.php')</script>";
}

else { echo "<center>Invalid Key!!"; }

}

elseif($action=="strep"){

	$res = mysql_query("select * from item_tbl where stock <= $stockrep");
	$row = mysql_num_rows($res);
	

echo "<div style='width:700px; margin:auto;'>";

echo "<table border='0' cellpadding=1 cellspacing=1 bgcolor='#000' width='70%'>
	<th>ItemID</th><th>Product Name</th><th>Category</th><th>Stocks left</th>";

for($x=0;$x<$row;$x++)
{
		
			$itemid  = mysql_result($res,$x,"itemid");
			$itemname = mysql_result($res,$x,"itemname");
			$catid =  mysql_result($res,$x,"catid");
			$stock =  mysql_result($res,$x,"stock");
			$picture =  mysql_result($res,$x,"picture");
			$description = mysql_result($res,$x,"description");
			$category = mysql_result(mysql_query("select * from category_tbl where catid=$catid"),0,"description");

		if($stock == 0) { $c = "#AC1614"; }
		else	{ $c = "#0174FF"; }
		
			echo "<tr>
				<td align='center'>$itemid</td>
				<td><a href='admin.php?id=$itemid&action=editprod'><font color='$c'>$itemname</font></a></td>
				<td>$category</td>
				<td align='center'>$stock</td>
				</tr>"; 
}


echo "</table>";

}

elseif($action=="stockeval"){

echo "<div style='width:700px; margin:auto;'>";

echo "<table cellspacing=1 bgcolor='#000000' border=0 cellpadding=1 width=100%><th width=60>ItemID</th>
	<th width=250>Item name</th><th width=100>Cost</th><th width=100>QTY Left</th><th>Amount</th>";

	$res = mysql_query("select * from item_tbl");
	$row = mysql_num_rows($res);

	for($i=0;$i<$row;$i++){

			$id  = mysql_result($res,$i,"itemid");
			$itemname = mysql_result($res,$i,"itemname");
			$catid =  mysql_result($res,$i,"catid");
			$qty =  (int)mysql_result($res,$i,"stock");
			$picture =  mysql_result($res,$i,"picture");
			$description = mysql_result($res,$i,"description");
			$itemcost = mysql_result($res,$i,"cost");

		$amount = $itemcost * $qty;
		$total = $total + $amount;

	if($qty>=1){
	echo "
		<tr>
		<td align='center'>$id</td>
		<td>$itemname</td>
		<td align='right'>".number_format($itemcost)."</td>
		<td align='center'>$qty</td>
		<td align='right'>".number_format($amount)."</td>
		</tr>";
	}
	}

echo "<tr><td></td><td></td><td></td><td align='center'><b>TOTAL</b></td><td align='right'>
	<font color='#0174d9'><b>P".number_format($total)."</b></font></td></tr>";

echo "</table></div>";

}


elseif($action=="viewpaid"){


echo "<div style='width:700px; margin:auto;'>";


$query = "select * from `transaction_tbl` where `orderstat`='paid' order by `tid` DESC";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_num_rows($result);


echo "<table border='0' cellspacing='1' cellpadding='1' bgcolor='#000'>";
echo "<th width='60'>ItemID</th><th width='250'>Item name</th><th width='150'>Client name</th>
	<th width='60'>Qty</th><th width='75'>Cost</th><th width='100'>Amount</th>";
for($x=0;$x<$row;$x++)
	{
	$name = mysql_result($result,$x,"fname");
	$prodname = mysql_result($result,$x,"productname");
	$qty = (int)mysql_result($result,$x,"quantity");
	$trno = mysql_result($result,$x,"key");
	$tid = mysql_result($result,$x,"tid");
	$pid = mysql_result($result,$x,"productid");
	$cost = (int)mysql_result($result,$x,"price");
	$price = $qty * $cost;
	$total = $total + $price;
	echo "
		<tr>
		<td align='center'>$pid</td>
		<td>$prodname</td>
		<td>$name</td>
		<td align='center'>$qty</td>
		<td align='right'>".number_format($cost)."</td>
		<td align='right'>".number_format($price)."</td>
		</tr>";
	}

echo "<tr><td></td><td></td><td></td><td></td><td align='center'><b>TOTAL</b>
	<td align='right'><font color='#0174d9'><b>P".number_format($total)."</b></font></td></tr>";
echo "</table></div>";
}



else

{

echo "<div style='width:700px; margin:auto;'>";


$query = "select * from `transaction_tbl` where `orderstat`='pending' order by `quantity` desc limit 20";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_num_rows($result);


echo "<b>Pending List($row)</b><br><hr>";

for($x=0;$x<$row;$x++)
	{
	$name = mysql_result($result,$x,"fname");
	$prodname = mysql_result($result,$x,"productname");
	$qty = (int)mysql_result($result,$x,"quantity");
	$trno = mysql_result($result,$x,"key");
	$tid = mysql_result($result,$x,"tid");
	$cost = (int)mysql_result($result,$x,"price");
	$price = number_format($qty * $cost);
	echo "<a href='admin.php?action=viewtr&tid=$tid' class='a'><div class='a'>
		Item: $prodname<br>
		Price: P$price <br>
		Buyer: $name <br>
		Key: $trno</div></a><hr>";
	}

echo "</div>";
}



?>