<?php
// Full server path to WHM DW
$full_server_path = "";

// MySQL database where the WHM DW data will be stored
$dbhostname = "localhost";
$dbname = "";
$dbusername = "";
$dbpassword = "";

// Your CPANEL Settings
$cpanel_protocol = "https"; // http for unsecure, https for secure
$cpanel_hostname = ""; // you server's hostname
$cpanel_port = "2083"; // Usually 2083 for secure (https) and 2082 for unsecure (http)

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
$section_heading_list_accounts_success = "$section_heading - List Of Accounts On $whm_hostname";
$section_heading_list_accounts_failure = "$section_heading - Unable To List Accounts";
$section_heading_list_dns = "$section_heading - List DNS Zones";
$section_heading_list_dns_success = "$section_heading - List Of DNS Zones On $whm_hostname";
$section_heading_list_dns_failure = "$section_heading - Unable To List DNS Zones";

// Misc
$list_marker = "# ";
$list_marker_font = "#DD0000";
$table_highlight_color = "#F1F1F1";
?>