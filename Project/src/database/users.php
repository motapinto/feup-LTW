<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    //Returns all comments for a news with id = id
    function checkIfUserExists($username, $password){
        global $db;

        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch();

        $passwordVerification = sha1($password);
        
        if($passwordVerification === $user['password'])
            return true;

        else 
            return false;
        
    }
?>