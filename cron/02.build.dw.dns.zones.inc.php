<?php
// 02.build.dw.dns.zones.inc.php
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