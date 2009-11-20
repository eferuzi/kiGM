<?php
	#TODO: these needs to be moved to a config.php

	$hostname = "localhost";
	$username = "root";
	$password = "rootpass";	
	$databasename = "kigm-dev";
	$connection = new  mysqli($hostname, $username, $password, $databasename);
	
	if($connection->connect_error){
		echo "Connection Error (".$connection->errno.")". $connection->error;
	}
?>
