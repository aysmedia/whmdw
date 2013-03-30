<?php
// index.php
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
<head><?php include($full_server_path . "_includes/head-tags.inc.php"); ?></head>
<body>
<?php include($full_server_path . "_includes/header.inc.php"); ?>
<font class="section_heading"><?=$section_heading?></font><?php include($full_server_path . "_includes/menus/whm.inc.php"); ?>
<BR><BR>
<?php
$sql = "select count(*) as total_count from _dw_whm_accounts";
$result = mysql_query($sql,$connection);

if ($result) {

	while ($row = mysql_fetch_object($result)) {
		$number_of_accounts = number_format($row->total_count);
	}

	?>
	<strong>Accounts</strong> (<?=$number_of_accounts?> Accounts)<BR>
	<font class="list_marker"><?=$list_marker?></font><a href="list-accounts.php">List Accounts</a>
	<?php

} else { 

	echo "No accounts exist.";

}
?>
<BR><BR>
<?php
$sql = "select count(*) as total_count from _dw_whm_dns_zones";
$result = mysql_query($sql,$connection);

if ($result) {

	while ($row = mysql_fetch_object($result)) {
		$number_of_dns_zones = number_format($row->total_count);
	}

	$sql = "select count(*) as total_count from _dw_whm_dns_records";
	$result = mysql_query($sql,$connection);

	while ($row = mysql_fetch_object($result)) { 
		$number_of_dns_records = number_format($row->total_count);
	}

	?>
	<strong>DNS</strong> (<?=$number_of_dns_zones?> Zones /  <?=$number_of_dns_records?> Records)<BR>
	<font class="list_marker"><?=$list_marker?></font><a href="list-dns-zones.php">List DNS Zones & Records</a>
	<?php

} else { 

	echo "No DNS zones exist.";

}
?>
<BR><BR>
<BR><font class="section_heading">Maintenance</font><BR>
<font class="list_marker"><?=$list_marker?></font><a target="_blank" href="cron/index.php">Rebuild Data Warehouse</a><BR>
Depending on the amount of information stored on your server this could take a few minutes to complete.<BR><BR>
If you're going to use the DW regularly you can also setup a cron job to /cron/index.php.<BR><BR>

<font class="list_marker"><?=$list_marker?></font><strong>Accounts Without A DNS Zone</strong><BR>
<?php
$sql = "select domain
		from _dw_whm_accounts
		where domain not in (select domain from _dw_whm_dns_zones)
		order by domain asc";
$result = mysql_query($sql,$connection) or die(mysql_error());

while ($row = mysql_fetch_object($result)) {
	$account_list_raw .= "<a class=\"covert_link\" href=\"list-accounts.php?domain=" . $row->domain . "\">" . $row->domain . "</a>, ";
}

$account_list = substr($account_list_raw, 0, -2);

if ($account_list != "") { 
	echo $account_list;
} else {
	echo "n/a";
}
?><BR><BR>
<font class="list_marker"><?=$list_marker?></font><strong>DNS Zones Without An Account</strong><BR>
<?php
$sql = "select domain
		from _dw_whm_dns_zones
		where domain not in (select domain from _dw_whm_accounts)
		order by domain asc";
$result = mysql_query($sql,$connection) or die(mysql_error());

while ($row = mysql_fetch_object($result)) {
	$zone_list_raw .= "<a class=\"covert_link\" href=\"list-dns-zones.php?domain=" . $row->domain . "\">" . $row->domain . "</a>, ";
}

$zone_list = substr($zone_list_raw, 0, -2);

if ($zone_list != "") { 
	echo $zone_list;
} else {
	echo "n/a";
}

?><BR><BR>
<?php include($full_server_path . "_includes/footer.inc.php"); ?>
</body>
</html>