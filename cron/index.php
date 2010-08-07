<?php include("../_includes/config.inc.php"); ?>
<?php include("../_includes/database.inc.php"); ?>
<?php include("../_includes/current-timestamp.inc.php"); ?>
<?php 
// ------------------------------------------------------------------------
// Execute the DW Builds
// ------------------------------------------------------------------------
//  Accounts
	include("01.build.dw.accounts.inc.php"); 
// ------------------------------------------------------------------------
//  DNS Zones
	include("02.build.dw.dns.zones.inc.php"); 
// ------------------------------------------------------------------------
//  DNS Zones (Data)
	include("03.build.dw.dns.records.inc.php"); 
// ------------------------------------------------------------------------
?>
<BR>WHM Data Warehouse Rebuilt.