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

function suggestions(){
	global $connection;
	
		$query="SELECT en_id, en_word FROM gm_en WHERE en_word LIKE ? ORDER BY en_word";
	}else{
		$query="SELECT en_id, en_word FROM gm_en ORDER BY en_word";
	}
}
?>
