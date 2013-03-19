<?php include($full_server_path . "_includes/auth/session-start.inc.php"); ?>
<?php include($full_server_path . "_includes/auth/login-check.inc.php"); ?>
<?php include($full_server_path . "_includes/top.inc.php"); ?>
<?php include($full_server_path . "_includes/config.inc.php"); ?>
<?php include($full_server_path . "_includes/database.inc.php"); ?>
<html>
<head><?php include($full_server_path . "_includes/head-tags.inc.php"); ?>
<?php include($full_server_path . "_includes/code/pagination.function.inc.php"); ?>
</head>
<body onLoad="document.forms[0].elements[0].focus()";>
<?php
$domain = $_GET['domain'];
$search_for = $_POST['search_for'];
?>
<?php include($full_server_path . "_includes/header.inc.php"); ?>
<?php
if ($domain != "") {

		$sql = "select *
				from _dw_whm_dns_records
				where domain = '$domain'
				group by domain
				order by domain, line asc";

} else {

	if ($search_for != "") {

		$sql = "select *
				from _dw_whm_dns_records
				where (
						(
						domain like '%$search_for%' or 
						name like '%$search_for%' or 
						address like '%$search_for%' or 
						exchange like '%$search_for%' or 
						cname like '%$search_for%' or 
						mname like '%$search_for%' or 
						nsdname like '%$search_for%' or 
						raw like '%$search_for%' or 
						rname like '%$search_for%' or 
						txtdata like '%$search_for%'
						)
					   )
		
				group by domain
				order by domain, line asc";

	} else {

		$sql = "select *
				from _dw_whm_dns_records
				group by domain
				order by domain, line asc";

	}
}
$totalrows = mysql_num_rows(mysql_query($sql));
$navigate = pageBrowser($totalrows,15,5,"&search_for=$search_for",$_GET[numBegin],$_GET[begin],$_GET[num]);
$sql = $sql.$navigate[0];
$result = mysql_query($sql,$connection) or die(mysql_error());

if($result)
{
	?>
	<font class="section_heading"><?=$section_heading_list_dns_success?></font><?php include($full_server_path . "_includes/menus/whm.list.dns.success.inc.php"); ?>
	<BR><BR>
<form name="form1" method="post" action="<?=$PHP_SELF?>">
    <input type="text" name="search_for" size="8" value="<?=$search_for?>"><BR>
    <input type="image" border="0" src="images/invisible-pixel.gif" alt="Search" name="submit">
</form>

	<?php
	echo "<strong>Number of DNS Zones:</strong> $totalrows<BR>";
	?>

<?php include($full_server_path . "_includes/code/pagination.menu.inc.php"); ?>
    
    <table border="<?php if ($border == "1") { echo "1"; } else { echo "0"; } ?>">
    	<tr>
        	<td width="220">&nbsp;</td>
        	<td>&nbsp;</td>
		</tr>
<?php
	while ($row = mysql_fetch_object($result)) {
$visible_domain = wordwrap($row->domain, 22, "<BR>", true);

$sql_zone = "select zonefile
			 from _dw_whm_dns_zones
			 where domain = '$row->domain'";
$result_zone = mysql_query($sql_zone,$connection);
while ($row_zone = mysql_fetch_object($result_zone)) {
	$visible_zonefile = wordwrap($row_zone->zonefile, 22, "<BR>", true);
}

		echo "<tr height=\"75\" valign=\"top\" onMouseOver=\"this.bgColor='" . $table_highlight_color . "';\" onMouseOut=\"this.bgColor='#FFFFFF';\">";
		echo "<td><font class=\"list_marker\">" . $list_marker . "</font><!a target=\"_blank\" href=\"http://" . $row->domain . "\"><strong>" . $visible_zonefile . "</strong><!/a><BR><BR><strong>Domain:</strong><BR><a class=\"covert_link\" href=\"list-accounts.php?domain=" . $row->domain . "\">" . $visible_domain . "</a>";
		
echo "</td>";
		echo "<td>";
		
		$sql2 = "select *
				from _dw_whm_dns_records
				where domain = '$row->domain'
				order by line asc";
		$result2 = mysql_query($sql2,$connection);

		while ($row2 = mysql_fetch_object($result2)) {
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="75" align="right" valign="top">
                <?php $wrapped_raw = wordwrap($row2->raw, 100, "<BR>", true); ?>
                <?php $wrapped_txtdata = wordwrap($row2->txtdata, 90, "<BR>", true); ?>
                <?php if ($row2->type != "") { ?> <strong><?=$row2->type?></strong><?php } ?>
                </td>
                <td valign="top" width="42">| <?php if ($row2->line < 10) echo "0"; ?><?=$row2->line?> |</td>
                <td>
                <?php if ($row2->name != "") { ?><?php if ($row2->type != "SOA" && $row2->type != "NS" && $row2->type != "A" && $row2->type != "MX" && $row2->type != "TXT" && $row2->type != "CNAME") { ?>Name: <?php } ?><?=$row2->name?><?php } ?>
                <?php if ($row2->address != "") { ?> | <?php if ($row2->type != "A") { ?>Address:<?php } ?> <?=$row2->address?><?php } ?>
                <?php if ($row2->exchange != "") { ?> | <?=$row2->exchange?><?php } ?>
                <?php if ($row2->preference != "" && $row2->type == "MX") { ?> | Preference: <?=$row2->preference?><?php } ?>
                <?php if ($row2->mname != "") { ?> | <?=$row2->mname?><?php } ?>
                <?php if ($row2->rname != "") { ?> | <?=$row2->rname?><?php } ?>
                <?php if ($row2->type == "SOA") { ?><?php if ($row2->ttl != "" && $row2->ttl != '0') { ?> | <?php if ($row2->type != "ZONE TTL" && $row2->type != "SOA" && $row2->type != "NS" && $row2->type != "A" && $row2->type != "MX" && $row2->type != "TXT" && $row2->type != "CNAME" && $row2->type != ":RAW" && $row2->type != "COMMENT") { ?>TTL: <?php } ?><?=$row2->ttl?><?php } ?><?php } ?>
                <?php if ($row2->serial != "" && $row2->serial != '0') { ?><BR>Serial: <?=$row2->serial?><?php } ?>
                <?php if ($row2->refresh != "" && $row2->refresh != '0') { ?> | Refresh: <?=$row2->refresh?><?php } ?>
                <?php if ($row2->retry != "" && $row2->retry != '0') { ?> | Retry: <?=$row2->retry?><?php } ?>
                <?php if ($row2->expire != "") { ?> | Expire: <?=$row2->expire?><?php } ?>
                <?php if ($row2->minimum != "" && $row2->minimum != '0') { ?> | Minimum TTL: <?=$row2->minimum?><?php } ?>
                <?php if ($row2->cname != "") { ?> | <?=$row2->cname?><?php } ?>
                <?php if ($row2->nsdname != "") { ?> | <?php if ($row2->type != "NS") { ?>NSDNAME: <?php } ?><?=$row2->nsdname?><?php } ?>
                <?php if ($row2->raw != "") { ?><?=$wrapped_raw?><?php } ?>
                <?php if ($row2->txtdata != "") { ?> | <?=$wrapped_txtdata?><?php } ?>
                <?php if ($row2->type != "SOA") { ?><?php if ($row2->ttl != "" && $row2->ttl != '0') { ?><?php if ($row2->type != "ZONE TTL") { ?> | <?php } ?><?php if ($row2->type != "ZONE TTL" && $row2->type != "SOA" && $row2->type != "NS" && $row2->type != "A" && $row2->type != "MX" && $row2->type != "TXT" && $row2->type != "CNAME" && $row2->type != ":RAW" && $row2->type != "COMMENT") { ?>TTL: <?php } ?><?=$row2->ttl?><?php } ?><?php } ?>
                <BR>
                </td>
            </tr>
	    </table>
			
		<?php
        }
		echo "<BR></td>";
		echo "</td>";
		echo "</tr>";
	}
//	}
?>
</table>
            

<?php
}
else
{
	?>
	<font class="section_heading"><?=$section_heading_list_domains_failure?></font><?php include($full_server_path . "_includes/menus/whm.list.dns.failure.inc.php"); ?>
	<BR><BR>
	<?php
	print_r($test->errors);
}
?>
<?php include($full_server_path . "_includes/code/pagination.menu.inc.php"); ?>
<BR>
<?php include($full_server_path . "_includes/footer.inc.php"); ?>
</body>
</html>