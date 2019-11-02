<?php
  session_start();                                                // starts the session
  include_once('database/connection.php');                        // connects to the database
  include_once('database/users.php');                             // users functions
  include_once('logout_action.php'); 
  
  $checkUserReturn = checkUser($_POST['email'], $_POST['password']);
  
  
  switch($checkUserReturn) { 
    case "User does not exist":
      if(addUser($_POST['email'], $_POST['password'], $_POST['name'], $_POST['age']))
        header('Location: login.php');                                 // login
      else 
        logOut($checkUserReturn);                                     // destroys session
      break;   
    
    default :
      logOut($checkUserReturn);                                     // destroys session
      break;                                
  }
?>