<?php
require_once ('../includes/connector.php');

class SessionManager {

  var $life_time;   
  
  function SessionManager() {
    
    // Read the maxlifetime setting from PHP
    $this->life_time = get_cfg_var("session.gc_maxlifetime");
    
    // Register this object as the session handler
    session_set_save_handler( 
    array( &$this, "open" ), 
    array( &$this, "close" ),
    array( &$this, "read" ),
    array( &$this, "write"),
    array( &$this, "destroy"),
    array( &$this, "gc" )
    );
  }
  
  function open( $save_path, $session_name ){
    
    global $sess_save_path;
    
    $sess_save_path = $save_path;
    
    return true;
  }
    
  function close() {
    return true;
  }
  
  function read( $id ) {
    global $connection;
    // Set empty result
    $data = '';
    
    // Fetch session data from the selected database
    $time = time();
    
    $id = $connection->real_escape_string($id);
    
    if($stmt = $connection->prepare("SELECT session_data FROM sessions WHERE session_id =? AND expires >?")){
      $stmt->bind_param('ss', $id, $time);      
      $stmt->execute();      
      $stmt->bind_result($data);      
      $stmt->fetch();      
      $stmt->close();
    }
    return $data;
  }
  
  function write( $id, $data ) {
    global $connection;
    // Set empty result
    $data = '';
    
    // Fetch session data from the selected database
    
    $id = $connection->real_escape_string($id);
    // Build query                
    $time = time() + $this->life_time;
    
    $data = $connection->real_escape_string($data);
    
    if($stmt = $connection->prepare("REPLACE sessions (session_id,session_data,expires) VALUES(?,?,?)")){    
      $stmt->bind_param('ssi', $id, $data, $time);    
      $stmt->execute();    
      $stmt->close();    
    }
    return true;
  }
  
  function destroy( $id ) {    
    if($stmt = $connection->prepare("DELETE FROM sessions WHERE session_id=?")){    
      $stmt->bind_param('s', $id);    
      $stmt->execute();    
      $stmt->close();    
    }
    return true;
  }
  
  
  function gc(){
    // Garbage Collection
   // Build DELETE query.  Delete all records who have passed the expiration time
   if($stmt = $connection->prepare("DELETE FROM sessions WHERE expires<?")){    
        $stmt->bind_param('s', 'UNIX_TIMESTAMP()');    
        $stmt->execute();    
        $stmt->close();    
      }
      return true;
  }
}
?>