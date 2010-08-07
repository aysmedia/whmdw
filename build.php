<?php include($full_server_path . "_includes/auth/session-start.inc.php"); ?>
<?php include($full_server_path . "_includes/auth/login-check.inc.php"); ?>
<?php include($full_server_path . "_includes/top.inc.php"); ?>
<?php include($full_server_path . "_includes/config.inc.php"); ?>
<?php include($full_server_path . "_includes/database.inc.php"); ?>
<?php include($full_server_path . "_includes/current-timestamp.inc.php"); ?>
<html>
<head><?php include($full_server_path . "_includes/head-tags.inc.php"); ?></head>
<body>
<?php include($full_server_path . "_includes/header.inc.php"); ?>
<font class="section_heading"><?=$section_heading_build_dw?></font><?php include($full_server_path . "_includes/menus/whm.build.dw.inc.php"); ?>
<?php
// ------------------------------------------------------------------------
// Execute the DW Builds
// ------------------------------------------------------------------------
//  Accounts
	include($full_server_path . "cron/01.build.dw.accounts.inc.php"); 
// ------------------------------------------------------------------------
//  DNS Zones
	include($full_server_path . "cron/02.build.dw.dns.zones.inc.php"); 
// ------------------------------------------------------------------------
//  DNS Zones (Data)
	include($full_server_path . "cron/03.build.dw.dns.records.inc.php"); 
// ------------------------------------------------------------------------
?>
<BR><BR><strong>whm data warehouse rebuilt.</strong>
<?php include($full_server_path . "_includes/footer.inc.php"); ?>
</body>
</html>