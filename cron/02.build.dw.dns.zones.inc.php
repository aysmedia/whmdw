<?php
$sql = "DROP TABLE IF EXISTS _dw_whm_dns_zones";
$result = mysql_query($sql,$connection) or die(mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS _dw_whm_dns_zones (
  id int(10) NOT NULL auto_increment,
  domain varchar(255) NOT NULL,
  zonefile varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$result = mysql_query($sql,$connection) or die(mysql_error());

$api_call = "/xml-api/listzones";
include("../_includes/code/api/whm.api.call.inc.php"); 
$xml = simplexml_load_string($result);

foreach($xml->zone as $hit){

	$sql = "insert into _dw_whm_dns_zones (domain, zonefile) values('$hit->domain', '$hit->zonefile')";
	$result = mysql_query($sql,$connection) or die(mysql_error());

}
?>