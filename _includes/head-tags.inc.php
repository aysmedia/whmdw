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