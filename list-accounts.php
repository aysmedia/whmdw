<?php
// list-accounts.php
// 
// WHM Data Warehouse - A web-based data warehouse application for WHM (Web Host Manager) written in PHP & MySQL.
// Copyright (C) 2010 Greg Chetcuti
// 
// WHM Data Warehouse is free software; you can redistribute it and/or modify it under the terms of the GNU
// General Public License as published by the Free Software Foundation; either version 2 of the License, or (at
// your option) any later version.
// 
// WHM Data Warehouse is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even
// the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public
// License for more details.
// 
// You should have received a copy of the GNU General Public License along with WHM Data Warehouse. If not,
// please see http://www.gnu.org/licenses/
?>
<?php include($full_server_path . "_includes/auth/session-start.inc.php"); ?>
<?php include($full_server_path . "_includes/auth/login-check.inc.php"); ?>
<?php include($full_server_path . "_includes/top.inc.php"); ?>
<?php include($full_server_path . "_includes/config.inc.php"); ?>
<?php include($full_server_path . "_includes/database.inc.php"); ?>
<html>
<head><?php include($full_server_path . "_includes/head-tags.inc.php"); ?>
<?php include($full_server_path . "_includes/code/pagination.function.inc.php"); ?>
</head>
<body onLoad="document.forms[0].elements[0].focus()";>
<?php
$domain = $_GET['domain'];
$search_for = $_POST['search_for'];
?>
<?php include($full_server_path . "_includes/header.inc.php"); ?>
<?php
if ($domain != "") {

		$sql = "select *
				from _dw_whm_accounts
				where domain = '$domain'
				order by unix_startdate desc";

} else {

	if ($search_for != "") {
	
		$sql = "select *
				from _dw_whm_accounts
				where (
						plan like '%$search_for%' or 
						theme like '%$search_for%' or 
						shell like '%$search_for%' or 
						suspendtime like '%$search_for%' or 
						ip like '%$search_for%' or 
						domain like '%$search_for%' or 
						partition like '%$search_for%' or 
						user like '%$search_for%' or 
						suspendreason like '%$search_for%' or 
						email = '$search_for' or 
						owner like '%$search_for%'
						)
				order by unix_startdate desc";
	
	} else {
	
		$sql = "select *
				from _dw_whm_accounts
				order by unix_startdate desc";
	
	}

}

$totalrows = mysql_num_rows(mysql_query($sql));
$navigate = pageBrowser($totalrows,15,10,"&search_for=$search_for",$_GET[numBegin],$_GET[begin],$_GET[num]);
$sql = $sql.$navigate[0];
$result = mysql_query($sql,$connection) or die(mysql_error());

if($result) {

	?>
	<font class="section_heading"><?=$section_heading_list_accounts_success?></font><?php include($full_server_path . "_includes/menus/whm.list.accounts.success.inc.php"); ?>
	<BR><BR>
    <form name="form1" method="post" action="<?=$PHP_SELF?>">
        <input type="text" name="search_for" size="8" value="<?=$search_for?>"><BR>
        <input type="image" border="0" src="images/invisible-pixel.gif" alt="Search" name="submit">
    </form>

	<?php
	echo "<strong>Number of Accounts:</strong> $totalrows<BR>";
	?>

	<?php include($full_server_path . "_includes/code/pagination.menu.inc.php"); ?>

    <table border="<?php if ($border == "1") { echo "1"; } else { echo "0"; } ?>">
    	<tr>
        	<td width="220">&nbsp;</td>
        	<td width="240">&nbsp;</td>
        	<td width="250">&nbsp;</td>
        	<td width="190">&nbsp;</td>
        	<td>&nbsp;</td>
		</tr>
	<?php

	while ($row = mysql_fetch_object($result)) {

		$visible_domain = wordwrap($row->domain, 20, "<BR>", true);
		echo "<tr height=\"75\" valign=\"top\" onMouseOver=\"this.bgColor='" . $table_highlight_color . "';\" onMouseOut=\"this.bgColor='#FFFFFF';\">";
		echo "<td><font class=\"list_marker\">" . $list_marker . "</font><!a target=\"_blank\" href=\"http://" . $row->domain . "\"><strong>" . $visible_domain . "</strong><!/a><BR>";


		$sql_zone = "select zonefile
					 from _dw_whm_dns_zones
					 where domain = '$row->domain'";
		$result_zone = mysql_query($sql_zone,$connection);

		while ($row_zone = mysql_fetch_object($result_zone)) {
			$visible_zonefile = wordwrap($row_zone->zonefile, 20, "<BR>", true);
		}

		echo "<BR><strong>DNS Zone:</strong><BR><a class=\"covert_link\" href=\"list-dns-zones.php?domain=$row->domain\">" . $visible_zonefile . "</a>";

		echo "</td>";
		echo "<td>" . 
				"<strong>Created:</strong> " . date("Y M jS", $row->unix_startdate) . "<BR>" . 
				"<strong>Contact:</strong> " . $row->email . "<BR>" . 
				"<strong>IP Address:</strong> " . $row->ip . "<BR> " .
				"<strong>Hosting Plan:</strong> " . $row->plan . "<BR>" . 
				"<strong>cPanel Theme:</strong> " . $row->theme . "<BR>" . 
				"<strong>User, Owner:</strong> " . $row->user . ", " . $row->owner . "<BR><BR>" . 
			"</td>";

		echo "<td>" . 
				"<strong>Shell:</strong> " . $row->shell . "<BR>" . 
				"<strong>Home:</strong> /" . $row->partition . "/" . $row->user . "<BR>" . 
				"<strong>HD Quota:</strong> " . $row->disklimit . "<BR>" . 
				"<strong>HD Used:</strong> " . number_format($row->diskused, 0, '.', ',') . "MB<BR>" . 
			"</td>";
		echo "<td>" . 
				"<strong>POP:</strong> " . $row->maxpop . "<BR>" . 
				"<strong>Lists:</strong> " . $row->maxlst . "<BR>" . 
				"<strong>Addons:</strong> " . $row->maxaddons . "<BR>" . 
				"<strong>Subdomains:</strong> " . $row->maxsub . "<BR>" . 
				"<strong>SQL:</strong> " . $row->maxsql . "<BR>" . 
				"<strong>FTP:</strong> " . $row->maxftp . "<BR>" . 
				"<strong>Parked:</strong> " . $row->maxparked . "<BR><BR>" . 
			"</td>";
		echo "<td>" . 
				"<strong>Suspended?</strong> " . $row->suspended . "<BR>" . 
				"<strong>When?</strong> " . $row->suspendtime . "<BR>" . 
				"<strong>Why?</strong> " . $row->suspendreason . "<BR>" . 
			"<BR><BR>" . 
			"</td>";
		echo "</tr>";
	}
	?>
	</table>
	<?php

} else {

	?>
	<font class="section_heading"><?=$section_heading_list_accounts_failure?></font><?php include($full_server_path . "_includes/menus/whm.list.accounts.failure.inc.php"); ?>
	<BR><BR>
	<?php
	print_r($test->errors);

}
?>
<?php include($full_server_path . "_includes/code/pagination.menu.inc.php"); ?>
<BR>
<?php include($full_server_path . "_includes/footer.inc.php"); ?>
</body>
</html>