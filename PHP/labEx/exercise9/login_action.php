<?php
  session_start(); // starts the session
  include_once('database/connection.php'); // connects to the database
  include_once('database/users.php');      // loads the functions responsible for the users table

  if (checkIfUserExists($_POST['username'], $_POST['password'])) { // checks if user exists
    $_SESSION['username'] = $_POST['username']; // store the username
    include('list_news.php'); //logs out
  }  
  else {
    include('logout_action.php'); //logs out
  }

  //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>