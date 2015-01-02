<?php

/* SHOW PRODUCT BY ID */
function ShowIndexProd($number){
	
	$query4item = mysql_query("select * from item_tbl where itemid='$number'");
	$itemname = mysql_result($query4item,0,"itemname");
	$cost =  mysql_result($query4item,0,"cost");
	$stock =  mysql_result($query4item,0,"stock");
	$picture =  mysql_result($query4item,0,"picture");

	echo "
	<td class='BoxIndex' width='30%'>
		<a href='prodshow.php?id=$number'>
		<IMG SRC='prodimg/$picture' width=163 border=0 height=120></a> <BR><BR>
		<B><FONT COLOR='red'> $itemname </FONT></B> <BR>
		<B>Price:</B> P$cost<BR>
		<b>Stocks:</b> $stock
	</td>";

}



?>