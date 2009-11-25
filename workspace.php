<?php 
require_once ('includes/includes.php');

if(!isset($_SESSION['userid'])){
  $_SESSION['results']['message'] ="Please login to access Workspace";
  header("Location: index.php");
}

pageinit('workspace');
  startbody();
    pageheader();
    startpagecontent();
      startcontent();
        createaccountform();
      endcontent();
      startsidebar();
        createAccountInfo();
      endsidebar();
      divclear();
    endpagecontent();
    pagefooter();
  endbody();
pageend();
?>
