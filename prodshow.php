<?php

error_reporting(0);
include("header.php");
include("dbconnect.php");

$id = $_GET['id'];

	$query4item = mysql_query("select * from item_tbl where itemid='$id'");
	$itemname = mysql_result($query4item,0,"itemname");
	$cost =  mysql_result($query4item,0,"cost");
	$stock =  mysql_result($query4item,0,"stock");
	$picture =  mysql_result($query4item,0,"picture");
	$description = mysql_result($query4item,0,"description");

echo "
<table border='0' align='center' cellpadding='7' cellspacing='7' background='images/mybg.gif'>
	<tr>
		<td>
			<IMG SRC='prodimg/$picture' width=200 > <BR><BR>
			<B>Title:</B> $itemname <BR>
			<B>Price:</B> P$cost <BR>
			<B>Stocks Left:</B> $stock <BR>
		</td>
		<td width='100%'><B>Description:</B><br><br>$description</td>
	</tr>
</table><BR>"; 

echo "<form action='orderform.php' method=post>";
echo "<input type=hidden name=prid value='$id'>";
echo "<input type=hidden name=prodname value='$itemname'>";
echo "<input type=hidden name=price value='$cost'>";
echo "<input type=hidden name=stock value='$stock'>";
echo "<input type=submit name=submit value='order this product' style='font-size:11px'>";
echo "</form>";

include("footer.php");

?>