<?php include("dbconnect.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="SideTableHeading" background="images/table2_top_bg.gif" height="27">Category Index</td>
	</tr>
	<tr>
		<td bgcolor="#b9a993" height="1"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
	</tr>
	<tr>
		<td>
			
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td bgcolor="#b9a993" width="1"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
					<td>
						
						<table border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td>

								<?php
								$res1 = mysql_query("select * from category_tbl");
								$row1 = mysql_num_rows($res1);

								for($x=0;$x<$row1;$x++)
								{
									$catid = mysql_result($res1,$x,"catid");
									$category = mysql_result($res1,$x,"description");
								?>

								<table border="0" cellpadding="1" cellspacing="0">
									<tr>
										<td valign="middle">&nbsp;&nbsp;<a href="prod.php?cat=<?php echo $catid; ?>" class="cats"> &#187; <?php echo $category; ?></a></td>
									</tr>
								</table>

								<?php } ?>

								</td>
							</tr>
						</table>

					</td>
					<td bgcolor="#b9a993" width="1"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td background="images/table2_bottom_bg.gif" height="8"></td>
	</tr>
</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td class="SideTableHeading" background="images/table1_top_bg.gif" height="28">Current Specials</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td bgcolor="#cecece" width="1"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
						<td>
							<table align="center" border="0" cellpadding="4" cellspacing="0" width="100%">
								<tr>
									<td valign="bottom" width="33%">

									&nbsp;&nbsp;<B>&#187; <A HREF="about.php"> About Us</A> </B><br>
									&nbsp;&nbsp;<B>&#187; <A HREF="index.php"> Store</A> </B><br>
									&nbsp;&nbsp;<B>&#187; <A HREF="terms.php"> Terms & Conditions</A> </B><br>
									&nbsp;&nbsp;<B>&#187; <A HREF="contact.php"> Contact</A> </B><br>
									&nbsp;&nbsp;<B>&#187; <A HREF="howto.php"> How to buy</A> </B><br>

									</td>
								</tr>
							</table>

						</td>
						<td bgcolor="#cecece" width="1"><img src="images/spacer.gif" border="0" height="1" width="1"></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td background="images/table1_bottom_bg.gif" height="10"></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td height="6"><img src="images/spacer.gif" border="0" height="6" width="1"></td>
		</tr>
	</table>