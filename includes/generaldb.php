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
?>