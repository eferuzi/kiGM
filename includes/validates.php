<?php
  require_once ('generaldb.php');

/**
 * validating input based on conditions passed as an array
 */
function validateinput($inputname, $valuename, $condiotions){
  if(isset($_POST[$inputname])){
    
    $value = $_POST[$inputname];
    
    $condiotionschecks=array();  
    $index=0;
    foreach($condiotions as $condiotion){
      if($skipnext){
        $index++;
        $skipnext=false;
      }else{
        //echo $condiotion;
        switch($condiotion){
          case "required":          
            if(checkrequired($value, $condiotions[$index+1])){
              $condiotionschecks[$condiotion] = true;
            }else{
              $condiotionschecks[$condiotion] = array (false, " required to have a min. length of {$condiotions[$index+1]} chararcters");
            }
            
            $index++;
            $skipnext=true;
            break;
          case "email":
            if(checkemail($value)){
              $condiotionschecks[$condiotion] = true;
            }else{
              $condiotionschecks[$condiotion] = array (false, " invalid");
            }
            $index++;
            break;
          case "emailused":
            if(isemailused($value)){
              $condiotionschecks[$condiotion] = array (false, " used");
            }else{
              $condiotionschecks[$condiotion] = true;
            }
            $index++;
            break;
          case "username":
            if(checkusername($value)){
              $condiotionschecks[$condiotion] = true;
            }else{
              $condiotionschecks[$condiotion] = array (false, " used");
  
            }
            $index++;
            break;
          case "password":
            if(checkpassword($value)){
              $condiotionschecks[$condiotion] = true;
            }else{
              $condiotionschecks[$condiotion] = array (false, " required to have a min. length of 8 chararcters");
            }
            $index++;
            break;
          case "match|repassword":
            if(checkmatch($value, substr($condition, strpos($condition, "|")+1))){
              $condiotionschecks[$condiotion] = true;
            }else{
              $condiotionschecks[$condiotion] = array (false, " does not match");
            }
            $index++;
            break;
        }
      }
    }
    
    //construct a message
    $isvalid=true;
    $errormessage = $valuename . " fails on (";
    foreach($condiotionschecks as $check){
      if(is_array($check)) {
        $errormessage .= $check[1] ." ,";
        $isvalid=false;
      }
    }
    
    if($isvalid){
      return true;
    }else{
      return substr_replace($errormessage  ,"",-1). " )";
    }
  }else{
    return "There is not input with {$inputname} name";
  }
}

function checkmatch($value, $postindex){
  return $value == $_POST[$postindex];
}

function checkpassword($value){
  return strlen($value)>= 8;
}

function checkrequired($value, $length){
  return strlen($value)>= $length;
}

function checkusername($value){
  return !usernameused($value);
}
/**
* FROM: http://www.linuxjournal.com/article/9585 by  Douglas Lovell
*/

function checkemail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex){
      $isValid = false;
   }
   else{
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64){
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255){
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.'){
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local)){
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain)){
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',str_replace("\\\\","",$local))){
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))){
            $isValid = false;
         }
      }
      
      if ($isValid && !(checkdnsrr($domain,"MX") ||checkdnsrr($domain,"A"))){
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}
?>