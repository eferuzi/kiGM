<?php 
require_once ('../includes/connector.php');

session_start();

function insterConfigInfo($langcode, $groupemail) {
    $query = "INSERT INTO config VALUES('".$langcode."','".$groupemail."')";
    
    mysql_query($query) or die(mysql_error());
    
    return TRUE;
}

function createTranslationTables($langcode) {
    $translationtable = "gm_".$langcode;
    $tagtable = "tag_".$langcode;
    
    $query = "CREATE TABLE ".$translationtable." LIKE gm_tm;";
    mysql_query($query) or die(mysql_error());
    
    return TRUE;
}

function insteringDefaultsInfo($langcode) {
    $en_query = "SELECT en_id,en_tag FROM gm_en ORDER BY en_id";
    
    $result = mysql_query($en_query) or die(mysql_error());
    
    while ($row = mysql_fetch_object($result)) {
        $tr_query = "INSERT INTO gm_".$langcode."(id, tag, status) VALUES('".$row->en_id."','".$row->en_tag."',0)";
        
        mysql_query($tr_query) or die(mysql_error());
    }
    
    return TRUE;
}

$langcode = trim($_POST['langcode']);
$groupemail = trim($_POST['groupemail']);

$success = insterConfigInfo($langcode, $groupemail);
$success = createTranslationTables($langcode);
$success = insteringDefaultsInfo($langcode);

header("Location: ../index.php");

?>
