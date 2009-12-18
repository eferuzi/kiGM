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
	if($key){
		$query="SELECT en_id, en_word FROM gm_en WHERE en_word LIKE ? ORDER BY en_word";
	}else{
		$query="SELECT en_id, en_word FROM gm_en ORDER BY en_word";
	}
	
	if($stmt = $connection->prepare($query)){			
	
		if($key){
			$key="%".$key."%";
			$stmt->bind_param('s',$key);
		}		
		$stmt->execute();
		$resultcount=0;
		
		echo "COUNT " . $resultcount;
		
		$stmt->bind_result($en_id, $en_word);
?>
	<fieldset><legend>Terms</legend>		
		<div class="termsearch">
			<form action="?action=search" method="post">
			<input style="float: left;width: 96%;" name="searchkey" id="searchkey" type="text"/>
			<!--<input type="submit" value="Search" /> -->
			</form>
		</div>
		<div class="clear"></div>
<?php
		if($key){
?>
			<br /><a href="?clear=yes" title="List All" style="float:right;">List All</a><br />
<?php
		}		
?>
		<br />
    	<ul class="terms">
<?php
		
		while ($row = $stmt->fetch()) {
			$resultcount++;
?>
			<li><a href="?action=translate&id=<?php echo $en_id; ?>" title="Translate: <?php echo $en_word; ?>"><?php echo $en_word ?></a></li>
<?php	    
		}
			
		if($resultcount==0){		 
?>
			  <li><a href="?clear=yes" title="List All">No match found</a></li>
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

function wordinfo($wordid){
	$info = getenglishwordinfo($wordid);
	if($info==NULL ||$info==false){
		echo "Invalid Word ID";
	}else{
?>		
	<fieldset><legend>Word Info</legend>
		<div class="wordinfo">
			<div>
				<strong class="word"><?php echo $info['word']; ?></strong>&nbsp;&nbsp;<em><?php echo $info['sycgroup']; ?></em>
				<p class="definition"><?php echo $info['definition']; ?></p>
			</div>
<?php
		if(strlen(trim($info['comment']))>0){ 
?>		
			<div>
				<table style="border: none;" cellpadding="5" cellspacing="5">
					<tr>
						<td valign="top" style="width: 5em;"><strong>Comment:</strong></td>
						<td align="left" valign="top" ><?php echo trim($info['comment']); ?></td>
					</tr>
				</table>
			</div>
<?php 
		}
?>		
		</div>
<?php		
		workspace();
?>		
    </fieldset>
<?php 
	}
}
?>
