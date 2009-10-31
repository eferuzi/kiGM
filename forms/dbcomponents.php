<?php 
require_once ('includes/connector.php');

function languagesCombo() {
    $query = "SELECT * FROM languages ORDER BY name;";
    
    $result = mysql_query($query) or die(mysql_error());
    
?>
	<select name="langcode" id="langcode">
<?php 
    while ($row = mysql_fetch_object($result)) {
?>    	
       <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option> 
<?php
		
    }
}
?>
