<?php
// whm.api.call.inc.php
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
$query = "$whm_protocol://$whm_hostname:$whm_port$api_call";

$curl = curl_init();																												# Create Curl Object
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);																# Allow certs that do not match the domain
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);																# Allow self-signed certs
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);																# Return contents of transfer on curl_exec
$header[0] = "Authorization: WHM $whm_username:" . preg_replace("'(\r|\n)'","",$whm_hash);	# Remove newlines from the hash
curl_setopt($curl,CURLOPT_HTTPHEADER,$header);															# Set curl header
curl_setopt($curl, CURLOPT_URL, $query);																		# Set your URL
$result = curl_exec($curl);																									# Execute Query, assign to $result
if ($result == false) {
	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
}
curl_close($curl);
?>