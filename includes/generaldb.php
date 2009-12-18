<?php
require_once ('connector.php');
/**
 * trimming and cleaning the GET and POST
 */
function makeinputsafe(){

	global $connection;

	foreach ($_POST as $key => $value) {
		$_POST[$key] = $connection->real_escape_string(trim($value));
	}

	foreach ($_GET as $key => $value) {
		$_GET[$key] = $connection->real_escape_string(trim($value));
	}

	foreach ($_REQUEST as $key => $value) {
		$_REQUEST[$key] = $connection->real_escape_string(trim($value));
	}
}


function usernameused($username){

	global $connection;

	if($stmt = $connection->prepare("SELECT COUNT(*) FROM login WHERE username=?")){
			
		$stmt->bind_param('s', $username);
			
		$stmt->execute();
			
		$stmt->bind_result($usernamecount);
		$stmt->fetch();
			
		$stmt->close();
			
		if($usernamecount==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

/**
 * checks if email has been used
 */

function isemailused($email){

	global $connection;

	$email = $connection->real_escape_string($email);

	if($stmt = $connection->prepare("SELECT COUNT(*) FROM login WHERE email=?")){

		$stmt->bind_param('s', $email);

		$stmt->execute();

		$stmt->bind_result($emailcount);
		$stmt->fetch();

		$stmt->close();

		if($emailcount==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

/**
 * checks if username and password are valid
 */

function validuser($username, $password){

	global $connection;

	if($stmt = $connection->prepare("SELECT COUNT(*) FROM login WHERE username=? AND secretword=?")){

		$stmt->bind_param('ss', $username, md5($password));

		$stmt->execute();

		$stmt->bind_result($usercount);

		$stmt->fetch();

		$stmt->close();

		if($usercount==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

function getuserid($username){

	global $connection;

	if($stmt = $connection->prepare("SELECT id FROM login WHERE username=?")){

		$stmt->bind_param('s', $username);

		$stmt->execute();

		$stmt->bind_result($userid);

		$stmt->fetch();

		$stmt->close();

		if($userid>0){
			return $userid;
		}else{
			return 0;
		}
	}
}

function getUserFullname($userid){
	global $connection;

	if($stmt = $connection->prepare("SELECT fullname FROM login WHERE id=?")){

		$stmt->bind_param('i', $userid);

		$stmt->execute();

		$stmt->bind_result($fullname);

		$stmt->fetch();

		$stmt->close();

		if($fullname){
			return $fullname;
		}else{
			return NULL;
		}
	}
}

function validpassword($userid, $password){
	global $connection;
	$password = md5($password);

	if($stmt = $connection->prepare("SELECT COUNT(*) FROM login WHERE id=? AND secretword=?")){

		$stmt->bind_param('is', $userid, $password);

		$stmt->execute();

		$stmt->bind_result($usercount);

		$stmt->fetch();

		$stmt->close();

		if($usercount==1){
			return true;
		}else{
			return false;
		}
	}
}

function getenglishwordinfo($wordid){
	global $connection;
	if(validwordid($wordid)){
		$query="SELECT
				e.en_id AS id, e.en_word AS word,e.en_def AS definition,e.en_comment AS comment, s.shortname AS sycgroup
			FROM 
				gm_en AS e, sycgroup_en AS s,syc_word_en AS se 
			WHERE 
				e.en_id=se.word_id AND se.syc_id=s.id AND e.en_id=?";
		if($stmt = $connection->prepare($query)){

			$stmt->bind_param('i', $wordid);

			$stmt->execute();

			$stmt->bind_result($id, $word,$definition,$comment,$sycgroup);

			$stmt->fetch();

			$stmt->close();

			if($wordid==$id){
				return array('id'=>$id,'word'=>trim($word),'definition'=>trim($definition),'comment'=>trim($comment),'sycgroup'=>trim($sycgroup));
			}else{
				return false;
			}
		}
	}else{
		return NULL;
	}
}

function validwordid($id){
	global $connection;

	if($stmt = $connection->prepare("SELECT COUNT(*) FROM gm_en WHERE en_id=?")){

		$stmt->bind_param('i', $id);

		$stmt->execute();

		$stmt->bind_result($count);

		$stmt->fetch();

		$stmt->close();

		if($count==1){
			return true;
		}else{
			return false;
		}
	}
}
?>