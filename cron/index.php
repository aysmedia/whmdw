<?php
// index.php
// 
// WHM Data Warehouse - A simple Data Warehouse for WHM (Web Host Manager) written in PHP & MySQL.
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
The WHM Data Warehouse has been rebuilt.