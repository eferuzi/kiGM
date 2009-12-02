<?php
require_once ('../includes/connector.php');
require_once ('../includes/generaldb.php');
require_once ('../includes/validates.php');

session_start();

function inputsvalidation(){
	$validateresult= array();	
	$validateresult['curpassword'] = validateinput("curpassword", "Current Password", array("validpassword"));
	$validateresult['password'] = validateinput("password", "Password", array("password","match|repassword"));
	
	
	return $validateresult;
}

makeinputsafe();

if((strlen($_POST['curpassword'])<8 ||strlen($_POST['password'])<8 ||strlen($_POST['repassword'])<8 )){
	$_SESSION['results']['error'] = array(0,"All fields are required and password should be more than 8 characters.");
    header("Location: ../workspace.php?action=password");
}
	

$validates = inputsvalidation();
//print_r($validates);
$allinputvalid = true;

foreach($validates as $key => $value){
	//echo $value. $control;
	if($value!==true){
		$allinputvalid =false;
		$_SESSION['results'][$key] = array(0, $value );

	}else{
		$_SESSION['results'][$key] = array(1, $_POST[$key]);
		${$key} = $_POST[$key];
	}
}

if($allinputvalid){

	if($stmt = $connection->prepare("UPDATE login SET secretword=? WHERE id=?")){
		$stmt->bind_param('si', md5($password),$_POST['userid']);

		$stmt->execute();

		$stmt->close();

		unset($_SESSION['result']);
		$_SESSION['info'] = "Your password update successful.";
		header("Location: ../workspace.php");
	}else{
		printf("Prepared Statement Error: %s\n", $connection->error);
	}
}else{
	header("Location: ../workspace.php?action=password");
}

?>