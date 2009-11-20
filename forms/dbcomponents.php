<?php 
require_once ('includes/connector.php');

function languagesCombo() {
	
	global $connection;
	
    $query = "SELECT * FROM languages ORDER BY name;";
    
    $result = $connection->query($query);
    
?>
	<select name="langcode" id="langcode">
<?php 
    while ($row = $result->fetch_object()) {
?>    	
       <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option> 
<?php	
    }
}
?>
