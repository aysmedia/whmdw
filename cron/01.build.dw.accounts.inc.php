<?php
// 01.build.dw.accounts.inc.php
// 
// WHM Data Warehouse - A web-based data warehouse application for WHM (Web Host Manager) written in PHP & MySQL.
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
$sql = "DROP TABLE IF EXISTS _dw_whm_accounts";
$result = mysql_query($sql,$connection) or die(mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS _dw_whm_accounts (
  id int(10) NOT NULL auto_increment,
  domain varchar(255) NOT NULL,
  ip varchar(15) NOT NULL,
  owner varchar(255) NOT NULL,
  user varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  disklimit varchar(255) NOT NULL,
  diskused varchar(255) NOT NULL,
  partition varchar(255) NOT NULL,
  maxaddons varchar(255) NOT NULL,
  maxftp varchar(255) NOT NULL,
  maxlst varchar(255) NOT NULL,
  maxparked varchar(255) NOT NULL,
  maxpop varchar(255) NOT NULL,
  maxsql varchar(255) NOT NULL,
  maxsub varchar(255) NOT NULL,
  plan varchar(255) NOT NULL,
  theme varchar(255) NOT NULL,
  shell varchar(255) NOT NULL,
  startdate varchar(255) NOT NULL,
  unix_startdate int(10) NOT NULL,
  suspended varchar(255) NOT NULL,
  suspendreason varchar(255) NOT NULL,
  suspendtime varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$result = mysql_query($sql,$connection) or die(mysql_error());

if ($_SERVER['HTTP_HOST'] != "demos.aysmedia.com") {

	$api_call = "/xml-api/listaccts?searchtype=domain&search=";
	include("../_includes/code/api/whm.api.call.inc.php"); 
	$xml = simplexml_load_string($result);

	foreach($xml->acct as $hit){
	
		$sql = "insert into _dw_whm_accounts (domain, ip, owner, user, email, disklimit, diskused, partition, maxaddons, maxftp, maxlst, maxparked, maxpop, maxsql, maxsub, plan, theme, shell, startdate, unix_startdate, suspended, suspendreason, suspendtime) values('$hit->domain', '$hit->ip', '$hit->owner', '$hit->user', '$hit->email', '$hit->disklimit', '$hit->diskused', '$hit->partition', '$hit->maxaddons', '$hit->maxftp', '$hit->maxlst', '$hit->maxparked', '$hit->maxpop', '$hit->maxsql', '$hit->maxsub', '$hit->plan', '$hit->theme', '$hit->shell', '$hit->startdate', '$hit->unix_startdate', '$hit->suspended', '$hit->suspendreason', '$hit->suspendtime')";
		$result = mysql_query($sql,$connection) or die(mysql_error());
	
	}

} else {

	$sql = "insert into _dw_whm_accounts (domain, ip, owner, user, email, disklimit, diskused, partition, maxaddons, maxftp, maxlst, maxparked, maxpop, maxsql, maxsub, plan, theme, shell, startdate, unix_startdate, suspended, suspendreason, suspendtime) VALUES
			('aysmedia.com', '69.167.168.205', 'root', 'aysmedia', 'privacy@aysmedia.com', 'unlimited', '163M', 'home', '*unknown*', 'unlimited', 'unlimited', '*unknown*', 'unlimited', 'unlimited', 'unlimited', 'Unlimited', 'x3', '/bin/bash', '2010 Mar 20 08:43', 1279827578, '0', 'not suspended', 'null'),
			('aysmedia.ca', '69.167.168.206', 'root', 'aysmedi2', 'privacy@aysmedia.com', 'unlimited', '1M', 'home', '*unknown*', 'unlimited', 'unlimited', '*unknown*', 'unlimited', 'unlimited', 'unlimited', 'Unlimited', 'x3', '/usr/local/cpanel/bin/noshell', '2010 Mar 20 13:05', 1269104715, '0', 'not suspended', 'null'),
			('ays.me', '69.167.168.206', 'root', 'aysme', 'privacy@aysmedia.com', 'unlimited', '1M', 'home', '*unknown*', 'unlimited', 'unlimited', '*unknown*', 'unlimited', 'unlimited', 'unlimited', 'Unlimited', 'x3', '/usr/local/cpanel/bin/noshell', '2010 Jul 22 15:39', 1269089020, '0', 'not suspended', 'null');";
	$result = mysql_query($sql,$connection) or die(mysql_error());

}
?>