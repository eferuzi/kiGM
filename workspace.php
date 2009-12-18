<?php 
require_once ('includes/includes.php');

session_start();

if(!isset($_SESSION['userid'])){
  $_SESSION['results']['message'] ="Please login to access Workspace";
  header("Location: index.php");
}

$action="";
/* get the action */
if(isset($_GET['action'])){
	$action=$_GET['action'];
}

/* get the action */
if(isset($_POST['searchkey'])){
	$_SESSION['searchkey']=$_POST['searchkey'];
}

/*clear the search*/
if(isset($_GET['clear']) && $_GET['clear']=='yes'){
  unset($_SESSION['searchkey']);
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
      		case "translate":
			    if(isset($_GET['id']) && is_numeric($_GET['id'])){
					$wordid=$_GET['id'];
					wordinfo($wordid);
				}else{
					echo "Invalid word ID";
				}
				break;
      		default:
      			wordinfo(1);
      			break;			
      	}
      endcontent();
      startsidebar();
		  if(isset($_SESSION['info'])){
			 operationinformation();
			 unset($_SESSION['info']);
		  }
        accountInfo();
        filter($_SESSION['searchkey']);
      endsidebar();
      divclear();
    endpagecontent();
    pagefooter();
  endbody();
pageend();
?>
