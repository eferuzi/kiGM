<?php
require_once ('includes/connector.php');

function tagsmatcher(){
	
global $connection;	

	if($stmt = $connection->prepare("SELECT en_id, en_tag FROM gm_en ORDER BY en_word")){			
	
		$stmt->execute();
		
		$stmt->bind_result($word_id, $en_tag);
		$query= "INSERT INTO tag_word_en VALUES";
		while ($row = $stmt->fetch()) {
			if(strlen($en_tag)){
				foreach(explode(";", $en_tag) as $tag_id){
					 $query.="(".$tag_id.",".$word_id."),";
				}
	    	}
	    }		    
		$stmt->close();	
		$query=substr_replace($query,"",-1);
        $connection->query($query) or die($connection->error);
	}
}


function sycgroupsmatcher(){
	
global $connection;	

	if($stmt = $connection->prepare("SELECT s.id, w.en_id FROM  sycgroup_en AS s,gm_en AS w  WHERE  s.shortname=w.en_syn_group")){			
	
		$stmt->execute();
		
		$stmt->bind_result($syc_id, $word_id);
		$query= "INSERT INTO syc_word_en VALUES";
		while ($row = $stmt->fetch()) {			
			 $query.="(".$syc_id.",".$word_id."),";
	    }		    
		$stmt->close();	
		$query=substr_replace($query,"",-1);
        $connection->query($query) or die($connection->error);
	}
}

sycgroupsmatcher();

//tagsmatcher();