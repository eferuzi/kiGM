<?php

require_once ('connector.php');

function getcongifs(){
	
	global $connection;
	
	$query = "SELECT c.*, l.name FROM config AS c, languages AS l WHERE l.code = c.langcode";

	$result = $connection->query($query) or die($connection->error);

	if($result->num_rows!=1){
		return NULL;
	}else{
		$row = $result->fetch_object();
		$config = array();
		$config['langcode'] = $row->langcode;
		$config['groupemail'] = $row->groupemail;
		$config['language'] = $row->name;
		
		print_r($configs);

		return $config;
	}
}

$configs = getcongifs();

