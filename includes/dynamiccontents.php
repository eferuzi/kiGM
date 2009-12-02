<?php
require_once ('includes/connector.php');
require_once ('includes/init.php');
require_once ('includes/generaldb.php');

session_start();

function getTotalTerms(){

	global $configs, $connection;

	$result = $connection->query("SELECT COUNT(*) AS all_entries FROM gm_".$configs['langcode']) or die($connection->error);

	$row = $result->fetch_object() or die($connection->error);

	mysqli_free_result($result);

	return $row->all_entries;
}

function getUntranslatedTerms(){

	global $configs, $connection;

	$result = $connection->query("SELECT COUNT(*) AS untranslated_entries FROM gm_{$configs['langcode']} WHERE status='0' OR word IS NULL") or die($connection->error);

	$row = $result->fetch_object() or die($connection->error);

	return $row->untranslated_entries;
}


function getFuzzyTerms(){
	global $configs, $connection;

	$result =$connection->query("SELECT COUNT(*) AS fuzzy_entries FROM gm_".$configs['langcode']." WHERE status='1' AND word IS NOT NULL;") or die($connection->error);

	$row = $result->fetch_object() or die($connection->error);

	return $row->fuzzy_entries;
}


function getCompletedTerms(){
	global $configs, $connection;

	$result = $connection->query("SELECT COUNT(*) AS complete_entries FROM gm_".$configs['langcode']." WHERE status='2' AND word IS NULL;") or die($connection->error);

	$row =  $result->fetch_object() or die($connection->error);
		
	return $row->complete_entries;
}

function getTranslatorsCount(){
	global $configs, $connection;

	$result = $connection->query("SELECT COUNT(*) translators FROM login;") or die($connection->error);

	$row = $result->fetch_object() or die($connection->error);
		
	return $row->translators;
}

function statistics(){
	global $configs;

	?>
<h1>Statistics :: <span style="color: #000;"><?php echo $configs['language']; ?></span></h1>
<table width="100%">
	<thead>
		<th align="center">Total</th>
		<th align="center">Untranslated</th>
		<th align="center">Fuzzy</th>
		<th align="center">Complete</th>
		<th align="center">Translators</th>
	</thead>
	<tr>
		<td align="center"><?php echo getTotalTerms(); ?></td>
		<td align="center"><?php echo getUntranslatedTerms(); ?></td>
		<td align="center"><?php echo getFuzzyTerms(); ?></td>
		<td align="center"><?php echo getCompletedTerms(); ?></td>
		<td align="center"><?php echo getTranslatorsCount();?></td>
	</tr>
</table>
	<?php
}

function operationinformation(){
	?>
<div class="information"><?php echo $_SESSION['info']; ?></div>
	<?php
}

function accountInfo(){		
	?>
<fieldset><legend><?php echo getUserFullname($_SESSION['userid']); ?></legend>
<div class="center"><a href="?action=password" title="">Change Password</a> | 
<a href="actions/logout.php" title="Logout">Logout</a></div>
</fieldset>
	<?php
}

function filter($key=NULL) {
	global $connection;	

	if($stmt = $connection->prepare("SELECT en_id, en_word FROM gm_en ORDER BY en_word")){			
	
		$stmt->execute();
		
		$stmt->bind_result($en_id, $en_word);
?>
	<fieldset><legend>Terms</legend>
		<div>
			<form action="?action=search" method="post">
			<input style="float: left;width: 96%;" name="searchkey" id="searchkey" type="text"/>
			<input type="submit" value="Search" />
			</form>
		</div>
		<div class="clear"></div>
    	<ul class="terms">
<?php		
		while ($row = $stmt->fetch()) {
?>
			<li><a href="?action=translate&id=<?php echo $en_id; ?>"><?php echo $en_word ?></a></li>
<?php	    
	    }
?>
    	</ul>
    </fieldset>
   
<?php	    
		
		$stmt->close();		
	}else{
		printf("Prepared Statement Error: %s\n", $connection->error);
	}
}

?>