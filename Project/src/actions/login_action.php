<?php
  session_start();                                                // starts the session
  include_once('../database/connection.php');                        // connects to the database
  include_once('../database/users.php');                             // users functions
  include_once('logout_action.php');                              // destroys session
  

  if(!isset($_POST['email']) || !isset($_POST['password']))
    logOut('Email and password must be given');
  
  $checkUserReturn = checkUser($_POST['email'], $_POST['password']);
  
  switch($checkUserReturn) { 
    case "User does not exist":
      logOut($checkUserReturn);
      break;   
    
      case "User exists":
      $_SESSION['email'] = $_POST['email'];                        // store the username
      header('Location: listings_all.php');                                 // lists all listings
      break;                                
    
      case "User exists but wrong password":
      logOut($checkUserReturn);
      break;   
  }
?>