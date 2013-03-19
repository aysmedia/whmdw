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

$api_call = "/xml-api/listaccts?searchtype=domain&search=";
include("../_includes/code/api/whm.api.call.inc.php"); 
$xml = simplexml_load_string($result);

foreach($xml->acct as $hit){

	$sql = "insert into _dw_whm_accounts (domain, ip, owner, user, email, disklimit, diskused, partition, maxaddons, maxftp, maxlst, maxparked, maxpop, maxsql, maxsub, plan, theme, shell, startdate, unix_startdate, suspended, suspendreason, suspendtime) values('$hit->domain', '$hit->ip', '$hit->owner', '$hit->user', '$hit->email', '$hit->disklimit', '$hit->diskused', '$hit->partition', '$hit->maxaddons', '$hit->maxftp', '$hit->maxlst', '$hit->maxparked', '$hit->maxpop', '$hit->maxsql', '$hit->maxsub', '$hit->plan', '$hit->theme', '$hit->shell', '$hit->startdate', '$hit->unix_startdate', '$hit->suspended', '$hit->suspendreason', '$hit->suspendtime')";
	$result = mysql_query($sql,$connection) or die(mysql_error());

}
?>