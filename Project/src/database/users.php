<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    // Checks if the input user exists
    function checkIfUserExists($username, $password){
        global $db;

        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch();

        $passwordVerification = sha256($password);
        
        if($passwordVerification === $user['password'])
            return true;

        else 
            return false;
        
    }
?>