<?php
// This file runs at the very top of the site, right after the session has started and 
// the user has been authenticated. 
// 
// Variables set here can be used site-wide.
//
// This line will shrink the font size if it detects you're on a blackberry
if (ereg("BlackBerry", $_SERVER["HTTP_USER_AGENT"])) $is_mobile = "1";
?>