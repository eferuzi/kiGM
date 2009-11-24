<?php
require_once ('../includes/connector.php');
require_once ('../includes/generaldb.php');
require_once ('../includes/validates.php');

session_start();

function inputsvalidation(){
  $validateresult= array();
  
  $validateresult['fullname'] = validateinput("fullname", "Full name", array("required", 4));
  $validateresult['email'] = validateinput("email", "Email", array("required",5,"email", "emailused"));
  $validateresult['username'] = validateinput("username", "Username", array("required",4,"username"));
  $validateresult['password'] = validateinput("password", "Password", array("password","match|repassword"));
  
  return $validateresult;
}

makeinputsafe();

$validates = inputsvalidation();

$allinputvalid = true;

foreach($validates as $key => $value){
  //echo $value. $control;
  if($value!==true){
    $allinputvalid =false;
    $_SESSION['result'][$key] = array(0, $value );
    
  }else{
    $_SESSION['result'][$key] = array(1, $_POST[$key]);
    ${$key} = $_POST[$key];
  }
}

if($allinputvalid){
   
  if($stmt = $connection->prepare("INSERT INTO login (username,secretword,fullname,email) VALUES(?,?,?,?)")){
        $stmt->bind_param('ssss', $username,md5($password),$fullname,$email);
        
        $stmt->execute();
        
        $stmt->close();
        
        unset($_SESSION['result']);
        $_SESSION['info'] = "Your account as been created successful.";
        header("Location: ../index.php");
    }else{
        printf("Prepared Statement Error: %s\n", $connection->error);
    }    
}else{
  //print_r($_SESSION['result']);
 header("Location: ../createaccount.php");
}

//get and clean the values of the strings




?>