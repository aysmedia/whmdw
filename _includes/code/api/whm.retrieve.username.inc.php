<?php
// whm.retrieve.username.inc.php
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
<?php
// RETRIEVE ACCOUNT USERNAME BASED ON DOMAIN NAME
// input: $newdomain (make sure the domain is stored in $newdomain before executing this include file)
// output: $newusername (after this include runs, $newusername will contain the domain's account username)
$api_call = "/json-api/domainuserdata?domain=$newdomain";
include($full_server_path . "_includes/code/api/whm.api.call.inc.php"); // results stored in $results

$patterns = array(
"/(.*)(\"user\":\"([0-9a-zA-Z]*)\")(.*)/" => "$3"
);

$search = array_keys($patterns);
$replace = array_values($patterns);
$new_result = preg_replace($search, $replace, $result);
$newusername = $new_result;
?>