<?php
  session_start();                                                // starts the session
  include_once('database/connection.php');                        // connects to the database
  include_once('database/users.php');                             // users functions
  
  $checkUserReturn = checkUser($_POST['email'], $_POST['password']);
  
  switch($checkUserReturn) { 
    case "User does not exist":
      include('logout_action.php');                                // destroys session
      logOut($checkUserReturn);
      break;   
    
      case "User exists":
      $_SESSION['email'] = $_POST['email'];                        // store the username
      include('listings_all.php');                                 // lists all listings
      break;                                
    
      case "User exists but wrong password":
      include('logout_action.php');                                 // destroys session
      logOut($checkUserReturn);
      break;   
  }
?>