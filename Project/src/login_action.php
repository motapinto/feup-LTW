<?php
  session_start();                                                // starts the session
  include_once('database/connection.php');                        // connects to the database
  include_once('database/users.php');                             // users functions

  //if(!isset(_POST['username']) || !isset(_POST['username']) || 
    //_POST['username'] == '')
  
  if (checkIfUserExists($_POST['username'], $_POST['password'])) { // checks if user exists
    $_SESSION['username'] = $_POST['username'];                    // store the username
    include('listings_all.php');                                   // lists all listings
  }  
  else {
    include('logout_action.php'); //logs out
  }

  //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>