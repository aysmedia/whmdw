<?php
$sql = "DROP TABLE IF EXISTS _dw_whm_accounts";
$result = mysql_query($sql,$connection) or die(mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS _dw_whm_accounts (
  id int(10) NOT NULL auto_increment,
  startdate varchar(255) NOT NULL,
  plan varchar(255) NOT NULL,
  suspended varchar(255) NOT NULL,
  theme varchar(255) NOT NULL,
  shell varchar(255) NOT NULL,
  maxpop varchar(255) NOT NULL,
  maxlst varchar(255) NOT NULL,
  maxaddons varchar(255) NOT NULL,
  suspendtime varchar(255) NOT NULL,
  ip varchar(15) NOT NULL,
  maxsub varchar(255) NOT NULL,
  domain varchar(255) NOT NULL,
  maxsql varchar(255) NOT NULL,
  partition varchar(255) NOT NULL,
  maxftp varchar(255) NOT NULL,
  user varchar(255) NOT NULL,
  suspendreason varchar(255) NOT NULL,
  unix_startdate int(10) NOT NULL,
  diskused varchar(255) NOT NULL,
  maxparked varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  disklimit varchar(255) NOT NULL,
  owner varchar(255) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$result = mysql_query($sql,$connection) or die(mysql_error());

$api_call = "/json-api/listaccts?searchtype=domain&search=$search_for";

// results stored in $results
include("../_includes/code/api/whm.api.call.inc.php"); 

$result = ereg_replace("\":null\,\"","\":\"null\",\"",$result);
$result = preg_replace("/^([0-9a-zA-Z{\":\, ]*)\"acct\":\[/","",$result);

$patterns = array(

"/{\"startdate\":(\"|)([0-9a-zA-Z. :]*)(\"|)\," . 
"\"plan\":(\"|)([0-9a-zA-Z.]*)(\"|)\," . 
"\"suspended\":(\"|)([0-9]*)(\"|)\," . 
"\"theme\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"shell\":(\"|)([0-9a-zA-Z. :\/]*)(\"|)\," . 
"\"maxpop\":(\"|)([0-9a-zA-Z. :]*)(\"|)\," . 
"\"maxlst\":(\"|)([0-9a-zA-Z. :]*)(\"|)\," . 
"\"maxaddons\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"suspendtime\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"ip\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"maxsub\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"domain\":(\"|)([0-9a-zA-Z.-]*)(\"|)\," . 
"\"maxsql\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"partition\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"maxftp\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"user\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"suspendreason\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"unix_startdate\":(\"|)([0-9a-zA-Z. :]*)(\"|)\," . 
"\"diskused\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"maxparked\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"email\":(\"|)([0-9a-zA-Z. :@*]*)(\"|)\," . 
"\"disklimit\":(\"|)([0-9a-zA-Z. :*]*)(\"|)\," . 
"\"owner\":(\"|)([0-9a-zA-Z. :*]*)(\"|)(}\,|}]})/" =>

"insert into _dw_whm_accounts (startdate, plan, suspended, theme, shell, maxpop, maxlst, maxaddons, suspendtime, ip, maxsub, domain, maxsql, partition, maxftp, user, suspendreason, unix_startdate, diskused, maxparked, email, disklimit, owner) values('20$2', '$5', '$8', '$11', '$14', '$17', '$20', '$23', '$26', '$29', '$32', '$35', '$38', '$41', '$44', '$47', '$50', '$53', '$56', '$59', '$62', '$65', '$68');::::::::::",

/*
/* ORIGINAL - FULL LISTS - DO NOT DELETE!!!
startdate = '$2',
plan = '$5',
suspended = '$8',
theme = '$11',
shell = '$14',
maxpop = '$17',
maxlst = '$20',
maxaddons = '$23',
suspendtime = '$26',
ip = '$29',
maxsub = '$32',
domain = '$35',
maxsql = '$38',
partition = '$41',
maxftp = '$44',
user = '$47',
suspendreason = '$50',
unix_startdate = '$53',
diskused = '$56',
maxparked = '$59',
email = '$62',
disklimit = '$65',
owner = '$68'<BR><BR>
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