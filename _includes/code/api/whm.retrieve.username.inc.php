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