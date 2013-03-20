<?php
// config.SAMPLE.inc.php
// 
// WHM Data Warehouse - A Data Warehouse application for WHM (Web Host Manager) written in PHP & MySQL.
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
<?php
// Full server path to WHM DW
$full_server_path = "";

// MySQL database where the WHM DW data will be stored
$dbhostname = "localhost";
$dbname = "";
$dbusername = "";
$dbpassword = "";

// Your WHM Settings
$whm_protocol = "https"; // http for unsecure, https for secure
$whm_hostname = ""; // you server's hostname
$whm_port = "2087"; // Usually 2087 for secure (https) and 2086 for unsecure (http)
$whm_username = "";
$whm_password = "";

// To get your WHM HASH, login to your WHM and follow these steps.
// Under the 'Cluster/Remote Access' heading on the left, click on 'Setup Remote Access Key'
// Copy and paste the displayed key into the $whm_hash variable below
$whm_hash = "";

// Headings
$section_heading = "WHM Data Warehouse";
$section_heading_build_dw = "$section_heading - Rebuild Data Warehouse";
$section_heading_list_accounts = "$section_heading - List Accounts";
$section_heading_list_accounts_success = "$section_heading - List of Accounts on $whm_hostname";
$section_heading_list_accounts_failure = "$section_heading - Unable to List Accounts";
$section_heading_list_dns = "$section_heading - List DNS Zones";
$section_heading_list_dns_success = "$section_heading - List of DNS Zones on $whm_hostname";
$section_heading_list_dns_failure = "$section_heading - Unable to List DNS Zones";

// Misc
$list_marker = "# ";
$list_marker_font = "#DD0000";
$table_highlight_color = "#F1F1F1";
?>