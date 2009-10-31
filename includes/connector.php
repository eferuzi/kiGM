<?php
	$hostname = "localhost";
	$username = "root";
	$password = "rootpass";	
	$databasename = "kigm-dev";
	$connection = mysql_connect($hostname, $username, $password) or die(mysql_error());
	mysql_select_db($databasename, $connection) or die(mysql_error());
?>
