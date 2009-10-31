<?php 
function pageinit($pagename = '') {
    
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Tri Labs Ltd
http://www.trilabs.co.tz
Released for free under GPL
Title      : kiGM
Version    : 1.0
Released   : 20090703
Description: Translation tool for the Terminology Project
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>kiGM - <?php echo $pagename; ?> </title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php 
    }
    
    
    function startbody() {
        
    ?>
    <body>
        <div id="wrapper">
            <?php 
            }
            
            function endbody() {
                
            ?>
        </div>
    </body>
    <?php 
    }
    
    function pagefooter() {
        // Retrieve current year
        $year = date("Y");
        // Convert year to Roman numerals
        
        // Output the copyright statement
        
    ?>
    <div id="footer">
        <p id="legal">
            Copyright &copy; <?php echo $year; ?> <a href="http://www.trilabs.co.tz">Tri Labs</a>. All Rights Reserved. <a href="terms.php">Terms of Use</a>
        </p>
    </div>
    <?php 
    }
    
    function pageend() {
        
    ?>
</html>
<?php 
}

function pageheader() {
    
?>
<div id="header">
    <div id="logo">
        <h1><a href="index.php"><span class="blue">k</span><span class="red">i</span><span class="black">GM</span></a></h1>
        <h2><a href="http://www.trilabs.co.tz/communityproject/kigm">A Terminology Tool</a></h2>
    </div>
    <!-- end div#logo -->
    <div id="menu">
        <ul>
            <li>
                <a href="javascript:login()">login</a>
            </li>
            <li>
                <a href="#">kigm</a>
            </li>
            <li>
                <a href="#">home</a>
            </li>
        </ul>
    </div>
    <!-- end div#menu -->
</div>
<?php 
}

function startpagecontent() {
    
?>
<div id="page">
    <?php 
    }
    
    function endpagecontent() {
        
    ?>
</div>
<?php 
}

function startcontent() {
    
?>
<div id="content">
    <?php 
    }
    
    function endcontent() {
        
    ?>
</div>
<?php 
}

function startsidebar() {
    
?>
<div id="sidebar">
    <?php 
    }
    
    function endsidebar() {
        
    ?>
</div>
<?php 
}

function divclear() {
    
?>
<div style="clear: both; height: 1px">
</div>
<?php 
}
?>
