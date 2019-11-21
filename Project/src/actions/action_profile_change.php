<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions

    if(!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['age']) || !isset($_POST['password']) || !isset($_POST['control']))
        header('Location: ../profile/profile.php');
       
    $id = $_SESSION['id'];
    $newEmail = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    if($password != $_POST['control']){
        $_SESSION['msg'] = 'Password doesn\'t match';
        header("Location: ../profile/profile.php");
    }
    
    $ret = changeUser($id, $newEmail, $name, $age, $password);
    switch ($ret){
        case 0:
            if(isset($_SESSION['msg']))
                unset($_SESSION['msg']);
            break;
        
        case 1:
            $_SESSION['msg']='Invalid Parameters';
            break;

        case 2:
            $_SESSION['msg']='Email already exists';
            break;        
        
        default:
            break;
    }

    header("Location: ../profile/profile.php");
?>