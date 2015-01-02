<?php
error_reporting(0);
include("header.php");
include("dbconnect.php");

	$cat = $_GET['cat'];

	if(empty($_GET['page'])) { $page = 1; } else { $page = $_GET['page']; }

	$display = 9;
	$perpage=9;

	$start = ($page * $display) - $display;
	$end=$display*$page;

if ($start !="0") {
$new_page=$page-1;
$prev="<a href='".$_PHP_SELF."?page=$new_page&cat=$cat'><b> prevous page </a></b>";
}
else {
$prev="<a href='".$_PHP_SELF."?page=1&cat=$cat'><b> prevous page </a></b>";
}
if ($end < $s) {
$new_page1=$page+1;
$next="<a href='".$_PHP_SELF."?page=$new_page1&cat=$cat'><b> next page </a></b>";
}
else {
$next="<a href='".$_PHP_SELF."?page=$page&cat=$cat'><b> next page </a></b>";
}
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td background="images/mid_nav_bg.gif" height="25">

			<table class="TopNav" align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="TopNav" align="left" valign="top" width="100%">&nbsp;&nbsp;<a href="" class="nav"><?php echo $prev; ?> | <?php echo $next; ?></td>
				</tr>
			</table>

		</td>
	</tr>
</table>



<div style='width: 550px;  height: 550px; border: 0px; padding:2px; margin-bottom: 8px; background: #FFFFFF; overflow: auto; ' >
<?php

$query4item = mysql_query("select * from item_tbl where catid='$cat'");
$row = mysql_num_rows($query4item);

for($x=0;$x<$row;$x++) {
	$itemid = mysql_result($query4item,$x,"itemid");
	$itemname = mysql_result($query4item,$x,"itemname");
	$cost =  mysql_result($query4item,$x,"cost");
	$stock =  mysql_result($query4item,$x,"stock");
	$picture =  mysql_result($query4item,$x,"picture");
	$description = mysql_result($query4item,$x,"description");

	echo "
	<div class='myBosex'>
		<a href='prodshow.php?id=$itemid'>
			<IMG SRC='prodimg/$picture' width=150 border=0 height=120></a> <BR>
			<B>  $itemname </B> <BR>
			<b>Price:</b> P$cost
	</div>
	";
	}

?>
</div>
<?php include("footer.php");?>

