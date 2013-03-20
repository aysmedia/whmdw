<?php
// head-tags.inc.php
// 
// WHM Data Warehouse - A Data Warehouse application for WHM (Web Host Manager) written in PHP & MySQL.
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$site_title?></title>
<?php if ($is_mobile == "1") {
	$default_font_size = "5pt";
} else {
	$default_font_size = "10pt";
} ?>
<style type="text/css">
body {
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: <?=$default_font_size?>;
	margin-left: 0px; margin-right: auto;
}
table {
	border-spacing: 0px;
	border-collapse: collapse;
	/*	margin-left: auto; margin-right: auto; // centers the table */
}
td {
	font-size: <?=$default_font_size?>;
	margin: 1px; 
	padding: 1px; 
}
a:link { color: #3366CC; text-decoration: none; font-weight: bold; font-size: <?=$default_font_size?>; }
a:active { color: #DD0000; text-decoration: none; font-weight: bold; font-size: <?=$default_font_size?>; }
a:visited { color: #3366CC; text-decoration: none; font-weight: bold; font-size: <?=$default_font_size?>; }
a:hover { color: #DD0000; text-decoration: none; font-weight: bold; font-size: <?=$default_font_size?>; }
a.covert_link:link { color: #000000; text-decoration: none; font-weight: 100; font-size: <?=$default_font_size?>; }
a.covert_link:active { color: #DD0000; text-decoration: none; font-weight: 100; font-size: <?=$default_font_size?>; }
a.covert_link:visited { color: #000000; text-decoration: none; font-weight: 100; font-size: <?=$default_font_size?>; }
a.covert_link:hover { color: #DD0000; text-decoration: none; font-weight: 100; font-size: <?=$default_font_size?>; }
.list_marker {
	color: <?=$list_marker_font?>;
}
</style>
<style type="text/css">
.section_heading {
	color: #DD0000;
	font-size: 10pt;
	font-weight: bold;
}
</style>
<style type="text/css">
html { overflow-y: scroll; }
</style>