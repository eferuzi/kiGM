<?php 
require_once ('includes/includes.php');

if(!isset($_SESSION['userid'])){
  $_SESSION['results']['message'] ="Please login to access Workspace";
  header("Location: index.php");
}

$action="";
/* get the action */
if(isset($_GET['action'])){
	$action=$_GET['action'];
}

pageinit('workspace');
  startbody();
    pageheader();
    startpagecontent();
      startcontent();
      	switch ($action){
      		case "password":
      			changepassword();
      			break;
      		case "logout":
      			unset($_SESSION['userid']);
      			header("Location: index.php");
      			break;
      		default:
      			createaccountform();
      			break;			
      	}
      endcontent();
      startsidebar();
      	if(isset($_SESSION['info'])){
    		operationinformation();
    		unset($_SESSION['info']);
		}
        accountInfo();
        filter();
      endsidebar();
      divclear();
    endpagecontent();
    pagefooter();
  endbody();
pageend();
?>
