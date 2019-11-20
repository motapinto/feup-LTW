<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if(!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['age']) || !isset($_POST['password']) || !isset($_POST['control']))
        header('Location: ../profile/profile.php');

    $oldEmail = $_SESSION['email'];
    $newEmail = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    if($password != $_POST['control']){
        $_SESSION['msg'] = 'Password doesn\'t match';
    }

    if(changeUser($oldEmail, $newEmail, $name, $age, $password)){
      $_SESSION['email'] = $newEmail;
      if(isset($_SESSION['msg']))
        unset($_SESSION['msg']);
    }
    else 
      $_SESSION['msg']='Email already exists';

    header("Location: ../profile/profile.php");
?>