<?php
$connection = mysql_connect($dbhostname,$dbusername,$dbpassword) or die(mysql_error());
$database = mysql_select_db($dbname,$connection) or die(mysql_error());
?>