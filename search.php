<?php
error_reporting(0);
include("header.php");
include("dbconnect.php");

$query = $_GET['query'];
if($query){
	$res = mysql_query("select * from item_tbl where itemname like '%$query%'");
	$row = mysql_num_rows($res);
	
	for($i=0; $i<$row; $i++){
		$itemname = mysql_result($res,$i,"itemname");
		$cost =  mysql_result($res,$i,"cost");
		$itemid =  mysql_result($res,$i,"itemid");
		$picture =  mysql_result($res,$i,"picture");
		$description = mysql_result($res,$i,"description");

			echo "
			<table border='0' align='center' cellpadding='3' cellspacing='3'>
				<tr>
					<td bgcolor='#EEEEEE'><IMG SRC='prodimg/$picture' width='200' height= 130> <BR>
					<B>Title:</B> $itemname <BR>
					<B>Price:</B> P $cost<BR><BR>
					<a href='prodshow.php?id=$itemid'><b style='color:#000000; '>[ details ]</b></a>
					</td>
					<td bgcolor='#EEEEEE' width='100%'><B>About:</B> $description </td>
				</tr>
			</table>"; 
		
	}
}
?>
<?php include("footer.php");?>