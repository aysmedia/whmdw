<?php
// build.php
// 
// WHM Data Warehouse - A Data Warehouse for WHM (Web Host Manager), as well as cPanel, written in PHP & MySQL.
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