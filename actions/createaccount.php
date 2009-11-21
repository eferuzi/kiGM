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

print_r(inputsvalidation());


//get and clean the values of the strings




?>