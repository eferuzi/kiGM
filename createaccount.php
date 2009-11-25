<?php 
require_once ('includes/includes.php');

pageinit('home');
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
