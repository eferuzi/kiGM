<?php 
require_once ('includes/includes.php');
require_once ('actions/configchecks.php');

$isConfig = isConfigSet();

pageinit('home');

startbody();
pageheader();
startpagecontent();
startcontent();
if ($isConfig) {
    statistics();
} else {
    configform();
}
kigmintro();
endcontent();
startsidebar();

if(isset($_SESSION['info'])){
    operationinformation();
    unset($_SESSION['info']);
}

if ($isConfig) {
    loginform();
    newAccount();
} else {
    configInfo();
}
endsidebar();
divclear();
endpagecontent();
pagefooter();
endbody();
pageend();
?>
