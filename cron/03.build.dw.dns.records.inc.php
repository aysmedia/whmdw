<?php
// 03.build.dw.dns.records.inc.php
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
$sql = "DROP TABLE IF EXISTS _dw_whm_dns_records";
$result = mysql_query($sql,$connection) or die(mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS _dw_whm_dns_records (
  id int(10) NOT NULL auto_increment,
  domain varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  line int(5) NOT NULL,
  nlines int(5) NOT NULL,
  address varchar(255) NOT NULL,
  class varchar(255) NOT NULL,
  exchange varchar(255) NOT NULL,
  preference int(3) NOT NULL,
  expire varchar(255) NOT NULL,
  minimum int(10) NOT NULL,
  cname varchar(255) NOT NULL,
  mname varchar(255) NOT NULL,
  nsdname varchar(255) NOT NULL,
  raw longtext NOT NULL,
  refresh int(10) NOT NULL,
  retry int(10) NOT NULL,
  rname varchar(255) NOT NULL,
  serial int(20) NOT NULL,
  ttl int(10) NOT NULL,
  type varchar(255) NOT NULL,
  txtdata varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$result = mysql_query($sql,$connection) or die(mysql_error());

$sql_temp = "select domain
		from _dw_whm_accounts
		order by domain asc";
$result_temp = mysql_query($sql_temp,$connection) or die(mysql_error());

while ($row_temp = mysql_fetch_object($result_temp)) {

	$api_call = "/xml-api/dumpzone?domain=$row_temp->domain";
	include("../_includes/code/api/whm.api.call.inc.php"); 
	$xml = simplexml_load_string($result);
	
	foreach($xml->result->record as $hit){

		$sql = "insert into _dw_whm_dns_records (domain, name, line, nlines, address, class, exchange, preference, expire, minimum, cname, mname, nsdname, raw, refresh, retry, rname, serial, ttl, type, txtdata) values('$row_temp->domain', '$hit->name', '$hit->Line', '$hit->Lines', '$hit->address', '$hit->class', '$hit->exchange', '$hit->preference', '$hit->expire', '$hit->minimum', '$hit->cname', '$hit->mname', '$hit->nsdname', '$hit->raw', '$hit->refresh', '$hit->retry', '$hit->rname', '$hit->serial', '$hit->ttl', '$hit->type', '$hit->txtdata')";
		$result = mysql_query($sql,$connection) or die(mysql_error());
	
	}

}

$sql2 = "delete from _dw_whm_dns_records 
		 where type = ':RAW'
		 and raw = ''";
$result2 = mysql_query($sql2,$connection);

$sql2 = "delete from _dw_whm_dns_records 
		 where type = 'SRV'";
$result2 = mysql_query($sql2,$connection);

$sql2 = "update _dw_whm_dns_records 
		 set type = 'COMMENT'
		 where type = ':RAW'";
$result2 = mysql_query($sql2,$connection);

$sql2 = "update _dw_whm_dns_records 
		 set type = 'ZONE TTL'
		 where type = '\$TTL'";
$result2 = mysql_query($sql2,$connection);
?>