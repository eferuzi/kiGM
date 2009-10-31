<?php
    require_once ('includes/connector.php');

	function getTotalTerms(){
		$query = "SELECT COUNT(*) AS all_entries FROM gm_ahk;";
		$result = $result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result) or die(mysql_error());	
		
		return $row->all_entries;	
	}
	
	
	function getUntranslatedTerms(){
		$query = "SELECT COUNT(*) AS untranslated_entries FROM gm_ahk WHERE status='0' OR word IS NULL;";
		$result = $result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result) or die(mysql_error());
	
		return $row->untranslated_entries;	
	}
	
	
	function getFuzzyTerms(){
		$query = "SELECT COUNT(*) AS fuzzy_entries FROM gm_ahk WHERE status='1' AND word IS NOT NULL;";
		$result = $result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result) or die(mysql_error());
	
		return $row->fuzzy_entries;	
	}
	
	
	function getCompletedTerms(){
		$query = "SELECT COUNT(*) AS complete_entries FROM gm_ahk WHERE status='2' AND word IS NULL;";
		$result = $result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result) or die(mysql_error());
		 
		return $row->complete_entries;
	}
	
	function getTranslatorsCount(){
		$query = "SELECT COUNT(*) translators FROM login;";
		$result = $result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_object($result) or die(mysql_error());
		 
		return $row->translators;
	}

	function statistics(){	
?>
	<h1>Statistics</h1>
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
?>