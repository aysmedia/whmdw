<?php
// top.inc.php
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
<?php
// This file runs at the very top of the site, right after the session has started and 
// the user has been authenticated. 
// 
// Variables set here can be used site-wide.
//
// This line will shrink the font size if it detects you're on a blackberry
if (ereg("BlackBerry", $_SERVER["HTTP_USER_AGENT"])) $is_mobile = "1";
?>