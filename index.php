<?php
error_reporting(0);
include("header.php");
include("dbconnect.php");

$res1 = mysql_query("select * from item_tbl");
$row1 = mysql_num_rows($res1);

$n = range(1, $row1);
shuffle($n);

$rn1 = $n[0];
$rn2 = $n[1];
$rn3 = $n[2];
$rn4 = $n[3];
$rn5 = $n[4];
$rn6 = $n[5];


?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td background="images/mid_nav_bg.gif" height="25">
<table class="TopNav" align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
<td class="TopNav" align="left" valign="top" width="100%">&nbsp;&nbsp;<a href="index.php" class="nav">Musical Instruments</a> » Welcome</td>
</tr>
</table>

</td>
</tr>
<tr>
<td>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
</tr>
</table>


<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="100%" valign="top">
<div align="left">
<font class="HeadingFont">Welcome</font><br><br>

Finally your here on the biggest and the most popular site for buying quality musical instruments, we offer the biggest brand guitars and effects only in cheaper price. Finest Accessories, drums and many more payment is simple and easy, so what ya waiting for? explore and see now the difference.

 <br><br>
								
</div>
</td>
</tr>
</table>


<table class="CenterTableItems" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
<td class="CenterTableHeading" valign="top">Random Products</td>
</tr>
</table>



<table width='547' align='center' cellpadding='5' cellspacing='5'>
	<tr>
		<?php
			ShowIndexProd($rn1);
			ShowIndexProd($rn2);
			ShowIndexProd($rn3);
		?>
	</tr>
</TABLE>



<table width='547' align='center' cellpadding='5' cellspacing='5' >
	<tr>
		<?php
			ShowIndexProd($rn4);
			ShowIndexProd($rn5);
			ShowIndexProd($rn6);
		?>
	</tr>
</TABLE>



	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>
				
				
				</td>
			</tr>
		</table>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td background="images/bottom_area_top.gif" height="11"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
		</tr>		
		<tr>
			<td background="images/bottom_area_bottom.gif" height="20"></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>
		


<!--  end main -->
<?php include("footer.php");?>