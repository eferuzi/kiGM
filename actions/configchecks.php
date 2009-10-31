<?php 
require_once ('includes/connector.php');

function isConfigSet() {
    $query = "SELECT COUNT(*) AS configs FROM config";
    
    $result = mysql_query($query) or die(mysql_error());
	    
	$row= mysql_fetch_object($result);
	
		
    if ($row->configs == 1) {
        return true;
    } else {
        return false;
    }
}
?>
