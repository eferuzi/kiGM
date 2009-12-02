<?php

require_once ('../includes/connector.php');
require_once ('../includes/validates.php');
require_once ('../includes/generaldb.php');

session_start();

function inputsvalidation(){
  $validateresult= array();
  
  $validateresult['username'] = validateinput("username", "Username", array("required",4));
  $validateresult['secretword'] = validateinput("secretword", "Password", array("required",8));
  
   
 foreach($validateresult as $key => $value){
    //echo $value. $control;
    if($value!=1){
      $inputsvalid =false;
      $_SESSION['results']['message'] = "Username / Password is invalid";
      header("Location: ../index.php");
    }else{     
      ${$key} = $_POST[$key];  
    }
  }
  
  if(validuser($username, $secretword)){
    $_SESSION['userid'] = getuserid($username);
    header("Location: ../workspace.php");
  }else{
    $_SESSION['results']['message'] = "Username / Password is invalid";
    header("Location: ../index.php");
  }
}


makeinputsafe();



inputsvalidation();

?>