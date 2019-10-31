<?php
    include_once(__DIR__.'/connection.php');

    // Checks if the input user exists
    function checkIfUserExists($email, $password){
        global $db;

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        $passwordVerification = sha1($password);
            echo $password;
        
        //if($passwordVerification === $user['password'])
            //return true;

        //else 
            //return false;
        
    }
?>