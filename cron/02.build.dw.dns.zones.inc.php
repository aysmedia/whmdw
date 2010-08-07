<?php
$sql = "DROP TABLE IF EXISTS _dw_whm_dns_zones";
$result = mysql_query($sql,$connection) or die(mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS _dw_whm_dns_zones (
  id int(10) NOT NULL auto_increment,
  zonefile varchar(255) NOT NULL,
  domain varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$result = mysql_query($sql,$connection) or die(mysql_error());

$api_call = "/json-api/listzones";

include("../_includes/code/api/whm.api.call.inc.php"); 

$result = ereg_replace("\":null\,\"","\":\"null\",\"",$result);
$result = preg_replace("/^([0-9a-zA-Z{\":\, ]*)\"zone\":\[/","",$result);

$patterns = array(

"/{(\"zonefile\":\"([0-9a-zA-Z.-]*)\"\,)" . 
"(\"domain\":\"([0-9a-zA-Z.-]*)\"(}\,|}]}))/" =>

"insert into _dw_whm_dns_zones (zonefile, domain) values('$2', '$4');::::::::::",

/*
/* ORIGINAL - FULL LISTS - DO NOT DELETE!!!
zonefile = '$2',
domain = '$4'<BR><BR>
// ORIGINAL - FULL LISTS - DO NOT DELETE!!!
*/
);

$search = array_keys($patterns);
$replace = array_values($patterns);
$result = preg_replace($search, $replace, $result);

$result = explode("::::::::::", $result);

foreach ($result as $query) {
	
	$sql2 = $query;
	$result2 = mysql_query($sql2,$connection);
}
?>