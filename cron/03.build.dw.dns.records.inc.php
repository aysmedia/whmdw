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

	$api_call = "/json-api/dumpzone?domain=$row_temp->domain";
	
	// results stored in $results
	include("../_includes/code/api/whm.api.call.inc.php"); 
	
	$result = ereg_replace("\":null\,\"","\":\"null\",\"",$result);
	$result = preg_replace("/^([0-9a-zA-Z{\":\, \"\[]*)\"record\":\[/","",$result);
	$result = preg_replace("/\]\,\"statusmsg\":\"Zone Serialized\"}\]}/","",$result);
	
	$patterns = array(
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"raw\":(\"|);([0-9a-zA-Z \.:_\-*;]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"type\":(\"|)([0-9a-zA-Z\. :_\-*;$]*)(\"|)\," . 
	"\"name\":(\"|)([0-9a-zA-Z\. :_\-*;]*)(\"|)}\,/" => 
	
	"insert into _dw_whm_dns_records (domain, line, raw, ttl, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14');::::::::::",
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"type\":(\"|)([0-9a-zA-Z\. :_\-*;$]*)(\"|)\," . 
	"\"name\":(\"|)([0-9a-zA-Z\. :_\-*;]*)(\"|)}\,/" => 
	
	"insert into _dw_whm_dns_records (domain, line, ttl, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11');::::::::::",
	
	"/{\"serial\":(\"|)([0-9]*)(\"|)\," . 
	"\"minimum\":(\"|)([0-9]*)(\"|)\," . 
	"\"rname\":(\"|)([a-zA-Z0-9\.]*)(\"|)\," . 
	"\"refresh\":(\"|)([0-9]*)(\"|)\," . 
	"\"Lines\":(\"|)([0-9]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9.-]*)(\"|)\," . 
	"\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"retry\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"mname\":(\"|)([a-zA-Z0-9\.]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"expire\":(\"|)([0-9]*)(\"|)},/" => 
	
	"insert into _dw_whm_dns_records (domain, serial, minimum, rname, refresh, nlines, name, line, retry, ttl, class, mname, type, expire) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17', '$20', '$23', '$26', '$29', '$32', '$35', '$38');::::::::::",
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"nsdname\":(\"|)([a-zA-Z0-9\.]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)},/"  => 
	
	"insert into _dw_whm_dns_records (domain, line, nsdname, ttl, class, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17');::::::::::",
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"address\":(\"|)([0-9\.]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)}\,/" => 
	
	"insert into _dw_whm_dns_records (domain, line, ttl, address, class, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17');::::::::::",
	
	"/{\"L2ine\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"preference\":(\"|)([0-9]*)(\"|)\," . 
	"\"exchange\":(\"|)([a-zA-Z0-9\.-]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)}(\,|)/" => 
	
	"insert into _dw_whm_dns_records (domain, line, ttl, class, preference, exchange, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17', '$20');::::::::::",
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"txtdata\":(\"|)([a-zA-Z0-9 \"\\\=\-.:;+\/]*)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-_]*)\"}(,|)/" => 

	"insert into _dw_whm_dns_records (domain, line, ttl, class, txtdata, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$13', '$16');::::::::::",
	
	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"address\":(\"|)([0-9\.]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)}/" => 
	
	"insert into _dw_whm_dns_records (domain, line, ttl, address, class, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17');::::::::::",

	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"raw\":(\"|)([0-9a-zA-Z \.:_\-*;]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z:]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)},/" => 
	
	"insert into _dw_whm_dns_records (domain, line, raw, ttl, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14');::::::::::",

	"/{\"Line\":(\"|)([0-9]*)(\"|)\," . 
	"\"cname\":(\"|)([0-9a-zA-Z\. :_\-*;]*)(\"|)\," . 
	"\"ttl\":(\"|)([0-9]*)(\"|)\," . 
	"\"class\":(\"|)([a-zA-Z0-9]*)(\"|)\," . 
	"\"type\":(\"|)([a-zA-Z:]*)(\"|)\," . 
	"\"name\":(\"|)([a-zA-Z0-9\.\-]*)(\"|)},/" => 
	
	"insert into _dw_whm_dns_records (domain, line, cname, ttl, class, type, name) values('$row_temp->domain', '$2', '$5', '$8', '$11', '$14', '$17');::::::::::",

	);
	
	// I know that in the other two files, at this point I explained which search/replace
	// variables mapped to which items, but for this one... yeah, no. I just can't do it.
	// I'm all for documentation, but these are sections that shouldn't really be tinkered
	// with anyways, so I don't want to spend too much time documenting them.
	//
	// If you're able to play around in this area, you should be able to figure out what's
	// going on. However, you really shouldn't be playing with any of the build files
	// anyways, as they're the backbone of the software and could mess up your imported
	// data.
	//
	// Basically what I'm saying is, don't screw around, LOL.
	
	$search = array_keys($patterns);
	$replace = array_values($patterns);
	$result = preg_replace($search, $replace, $result);
	
	$result = explode("::::::::::", $result);
	
	foreach ($result as $query) {
		
		$sql2 = $query;
		$result2 = mysql_query($sql2,$connection);
	}

$sql2 = "delete from _dw_whm_dns_records 
		 where type = ':RAW'
		 and raw = ''";
$result2 = mysql_query($sql2,$connection);		 

$sql2 = "update _dw_whm_dns_records 
		 set type = 'COMMENT'
		 where type = ':RAW'";
$result2 = mysql_query($sql2,$connection);		 

$sql2 = "update _dw_whm_dns_records 
		 set type = 'ZONE TTL'
		 where type = '\$TTL'";
$result2 = mysql_query($sql2,$connection);		 
}
?>