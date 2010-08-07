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