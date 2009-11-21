<?php 
require_once ('../includes/connector.php');
require_once ('../includes/validates.php');

session_start();

function insterConfigInfo($langcode, $groupemail) {
    global $connection;
    
    if($stmt = $connection->prepare("INSERT INTO config VALUES(?,?)")){
        $stmt->bind_param('ss', $langcode, $groupemail);
        
        $stmt->execute();
        
        $stmt->close();
        
        return TRUE;
    }else{
        printf("Prepared Statement Error: %s\n", $connection->error);
        
        return FALSE;
    }    
    
}

function createTranslationTables($langcode){

    global $connection;

    $translationtable = "gm_".$langcode;
    $tagtable = "tag_".$langcode;
    
    $query = "CREATE TABLE ".$translationtable." LIKE gm_tm;";
    
    $connection->query($query) or die($connection->error);
    
    return TRUE;
}

function insteringDefaultsInfo($langcode){
    global $connection;

    if($stmt = $connection->prepare("SELECT en_id,en_tag FROM gm_en ORDER BY en_id")){
        
        $stmt->execute();
        
        $stmt->bind_result($en_id, $en_tag);
         $query = "INSERT INTO gm_".$langcode."(id, status) VALUES";
        while($stmt->fetch()){
             $query.="(".$en_id.",0),";
        }
        
        $stmt->close();
        $query=substr_replace($query,"",-1);
        $connection->query($query) or die($connection->error);
        
        return TRUE;
    }
}

$langcode = trim($_POST['langcode']);
$groupemail = $connection->real_escape_string(trim($_POST['groupemail']));

if(checkemail($groupemail)){
    $success = insterConfigInfo($langcode, $groupemail);
    $success = createTranslationTables($langcode);
    $success = insteringDefaultsInfo($langcode);
}else{
    $error= array();
    $error['email'] = "Invalid Translators Group Email";
    $_SESSION['config_error']=$error;
}


header("Location: ../index.php");

?>
