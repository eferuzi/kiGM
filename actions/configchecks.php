<?php 
require_once ('includes/connector.php');

function isConfigSet() {
	global $connection;
	
    $query = "SELECT COUNT(*) AS configs FROM config";
    
    $result = $connection->query($query);
	    
	$row= $result->fetch_object();;
	
		
    if ($row->configs == 1) {
        return true;
    } else {
        return false;
    }
}
?>
