<?php
  session_start();                                                // starts the session
  include_once('database/connection.php');                        // connects to the database
  include_once('database/users.php');                             // users functions
  
  $checkUserReturn = checkUser($_POST['name'], $_POST['age'], $_POST['email'], $_POST['password']);
  
  
  switch($checkUserReturn) { 
    case "User does not exist":
      $_SESSION['email'] = $_POST['email'];                        // store the username
      $pdoQuery = "INSERT INTO User(email, password, name, age) 
                    VALUES ($_POST['email'], '$_POST['email']', '...')"
      break;   
    
    default :
      include('logout_action.php'); 
      logOut($checkUserReturn);                                     // destroys session
      break;                                
  }
?>