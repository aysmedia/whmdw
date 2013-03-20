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

if ($_SERVER['HTTP_HOST'] != "demos.aysmedia.com") {

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
	
	$sql = "delete from _dw_whm_dns_records 
			 where type = ':RAW'
			 and raw = ''";
	$result = mysql_query($sql,$connection) or die(mysql_error());
	
	$sql = "delete from _dw_whm_dns_records 
			 where type = 'SRV'";
	$result = mysql_query($sql,$connection) or die(mysql_error());
	
	$sql = "update _dw_whm_dns_records 
			 set type = 'COMMENT'
			 where type = ':RAW'";
	$result = mysql_query($sql,$connection) or die(mysql_error());
	
	$sql = "update _dw_whm_dns_records 
			 set type = 'ZONE TTL'
			 where type = '\$TTL'";
	$result = mysql_query($sql,$connection) or die(mysql_error());

} else {

	$sql = "insert into _dw_whm_dns_records (domain, name, line, nlines, address, class, exchange, preference, expire, minimum, cname, mname, nsdname, raw, refresh, retry, rname, serial, ttl, type, txtdata) VALUES
			('ays.me', '', 1, 0, '', '', '', 0, '', 0, '', '', '', 'cPanel first:11.25.0-RELEASE_46156 latest:11.28.64-RELEASE_51024 Cpanel::ZoneFile::VERSION:1.3 mtime:1294546657 hostname:box.aysmedia.com', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('ays.me', '', 2, 0, '', '', '', 0, '', 0, '', '', '', 'Zone file for ays.me', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('ays.me', '', 3, 0, '', '', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'ZONE TTL', ''),
			('ays.me', 'ays.me.', 4, 7, '', 'IN', '', 0, '3600000', 86400, '', 'ns1.aysmedia.com', '', '', 86400, 7200, 'admin.aysmedia.com', 2010091711, 300, 'SOA', ''),
			('ays.me', 'ays.me.', 11, 0, '', 'IN', '', 0, '', 0, '', '', 'ns1.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('ays.me', 'ays.me.', 12, 0, '', 'IN', '', 0, '', 0, '', '', 'ns2.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('ays.me', 'ays.me.', 13, 0, '168.143.174.97', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('ays.me', 'www.ays.me.', 17, 0, '69.167.168.206', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('ays.me', 'ftp.ays.me.', 18, 0, '69.167.168.206', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('ays.me', 'ays.me.', 19, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"v=spf1 ip4:69.167.168.205 a mx -all\"'),
			('ays.me', 'ays.me.', 25, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 86400, 'TXT', '\"google-site-verification=DRh8xEKAH6w05-wA0dN6YPxIj6Y6AZx2pZhpHEHAyS0\"'),
			('aysmedia.ca', '', 1, 0, '', '', '', 0, '', 0, '', '', '', 'cPanel first:11.25.0-RELEASE_43473 latest:11.26.8-BETA_48361 Cpanel::ZoneFile::VERSION:1.3 mtime:1284738858 hostname:box.aysmedia.com', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('aysmedia.ca', '', 2, 0, '', '', '', 0, '', 0, '', '', '', 'Zone file for aysmedia.ca', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('aysmedia.ca', '', 3, 0, '', '', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'ZONE TTL', ''),
			('aysmedia.ca', 'aysmedia.ca.', 4, 7, '', 'IN', '', 0, '3600000', 86400, '', 'ns1.aysmedia.com', '', '', 86400, 7200, 'admin.aysmedia.com', 2010092500, 300, 'SOA', ''),
			('aysmedia.ca', 'aysmedia.ca.', 11, 0, '', 'IN', '', 0, '', 0, '', '', 'ns1.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('aysmedia.ca', 'aysmedia.ca.', 12, 0, '', 'IN', '', 0, '', 0, '', '', 'ns2.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('aysmedia.ca', 'aysmedia.ca.', 13, 0, '69.167.168.206', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.ca', 'www.aysmedia.ca.', 17, 0, '69.167.168.206', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.ca', 'ftp.aysmedia.ca.', 18, 0, '69.167.168.206', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.ca', 'aysmedia.ca.', 19, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"v=spf1 ip4:69.167.168.205 a mx -all\"'),
			('aysmedia.com', '', 1, 0, '', '', '', 0, '', 0, '', '', '', 'cPanel first:11.25.0-RELEASE_43473 latest:11.26.8-BETA_48361 Cpanel::ZoneFile::VERSION:1.3 mtime:1285433295 hostname:box.aysmedia.com', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('aysmedia.com', '', 2, 0, '', '', '', 0, '', 0, '', '', '', 'Zone file for aysmedia.com', 0, 0, '', 0, 86400, 'COMMENT', ''),
			('aysmedia.com', '', 3, 0, '', '', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'ZONE TTL', ''),
			('aysmedia.com', 'aysmedia.com.', 4, 7, '', 'IN', '', 0, '3600000', 86400, '', 'ns1.aysmedia.com', '', '', 86400, 7200, 'admin.aysmedia.com', 2011010900, 300, 'SOA', ''),
			('aysmedia.com', 'aysmedia.com.', 11, 0, '', 'IN', '', 0, '', 0, '', '', 'ns1.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('aysmedia.com', 'aysmedia.com.', 12, 0, '', 'IN', '', 0, '', 0, '', '', 'ns2.aysmedia.com', '', 0, 0, '', 0, 86400, 'NS', ''),
			('aysmedia.com', 'aysmedia.com.', 13, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'www.aysmedia.com.', 17, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'ftp.aysmedia.com.', 18, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'aysmedia.com.', 19, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"v=spf1 ip4:69.167.168.205 a mx include:gmail.com include:google.com -all\"'),
			('aysmedia.com', 'ns1.aysmedia.com.', 24, 0, '69.167.168.207', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'ns2.aysmedia.com.', 25, 0, '69.167.168.208', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'rbl.aysmedia.com.', 28, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'rbl2.aysmedia.com.', 29, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'demos.aysmedia.com.', 31, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'A', ''),
			('aysmedia.com', 'box.aysmedia.com.', 39, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"v=spf1 ip4:69.167.168.205 a mx include:gmail.com include:google.com -all\"'),
			('aysmedia.com', 'default._domainkey.aysmedia.com.', 40, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"k=rsa; p=MHwwDQYJKoZIhvcNAQEBBQADawAwaAJhAK4+nYS5XjRMnXZlCcsB6z+K8OCl8rdSu63rVx7SlYj2lVnggOA+uk7Sy2x++4WFhMaUIlUeJpRA5JHFd6az9eauxxzkmu6cl21zxyfG1CwpreG2AWPXAcqQxAtcPpGpMwIDAQAB;\"'),
			('aysmedia.com', 'default._domainkey.demos.aysmedia.com.', 42, 0, '', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 300, 'TXT', '\"k=rsa; p=MHwwDQYJKoZIhvcNAQEBBQADawAwaAJhAK6qVRNLvo7lgRYuGDUCkt0+3ppWYrvM2MlocL4qKRomRfKvUIUy5ybckI2C79BVvyq1/VMRpMnzsSKPe/7SpLZCbv6kUGPBXvfaGNQzh1+cmCb5OwMdr++IiBadIEOC+QIDAQAB;\"'),
			('aysmedia.com', 'repos.aysmedia.com.', 48, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 86400, 'A', ''),
			('aysmedia.com', 'www.repos.aysmedia.com.', 49, 0, '69.167.168.205', 'IN', '', 0, '', 0, '', '', '', '', 0, 0, '', 0, 86400, 'A', '');";
	$result = mysql_query($sql,$connection) or die(mysql_error());
}
?>