<?php

error_reporting(0);
include("header.php");

$prid = $_POST['prid'];

?>
	
<TABLE>
	<form action='sendorder.php' method='post'>
		<input type='hidden' name='prid' value='<?=$prid ?>'>
		<TR><TD><B>Product name:</B> </TD><TD><input readonly type=text name=prodname value="<?=$_POST['prodname']; ?>">
		<BR></TD></TR>
		<TR><TD><B>Price:</B> </TD><TD><input readonly type=text name=price value="<?=$_POST['price'].$curency;?>">
		<BR></TD></TR>
		<TR><TD><B>Stocks:</B> </TD><TD><input readonly type=text name=stock value="<?=$_POST['stock'];?>">
		<BR></TD></TR>
		<TR><TD>Quantity: </TD><TD><input type=text name=quantity ><BR></TD></TR>
		<TR><TD>Your full name: </TD><TD><input type=text name=name ><BR></TD></TR>
		<TR><TD>Your email: </TD><TD><input type=text name=email ><BR></TD></TR>
		<TR><TD>Your phone: </TD><TD><input type=text name=phone ><BR></TD></TR>
		<TR><TD>Location: </TD><TD><input type=text name=country ><BR></TD></TR>
		<TR><TD></TD><TD><input type=submit name=submit value='send order now'></TD></TR>
	</form>
</TABLE>

<?php include("footer.php");?>