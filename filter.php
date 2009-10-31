 <?php
   require_once 'includes/connector.php';



   function status(){
    

      $query = "select * from gm where status = 1";

        $result = mysql_query($query) or die("could not execute the query!!!");


          $total = mysql_num_rows($result);


                  echo "Completed terms ".$total;

                    }
  


   function filter($key=NULL) {
     $query = "SELECT id, sourceword FROM gm ORDER BY sourceword";
     /*if($key!=NULL){
         
     }else{
         
    }*/
  
    $result = mysql_query($query) or die(mysql_error());
  ?>
    <ul>
  <?php
    while ($row= mysql_fetch_object($result)) {
  ?>
      <li><a href="index1.php?action=translate&id=<?php echo $row->id; ?>"><?php echo $row->sourceword; ?></a></li>
  <?php
    }
  ?>
    </ul>
  <?php
  }
 ?>                                                                                                                                                                                               
