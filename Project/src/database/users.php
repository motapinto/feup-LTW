<?php
    include_once('../includes/database.php');      // connects to the database

    define("User does not exist", 1);
    define("User exists", 2);
    define("User exists but wrong password", 3);

    // Checks if the input user exists
    function checkUser($email, $password){
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if (!$user) 
            return "User does not exist";
        
        if(strtoupper(sha1($password)) === strtoupper($user['password']))
            return "User exists";

        else
            return "User exists but wrong password";
    }

    // Adds a new user to the database
    function addUser($email, $password, $name, $age){
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('INSERT INTO User (
                email,
                password,
                name,
                age,
                rating
            )
            VALUES (?, ?, ?, ?, NULL);
        ');
        $stmt->execute(array($email, sha1($password), $name, $age));
        $user = $stmt->fetch();
        return !$user?true:false;
    }

    function userProfile($email) {
        $db = Database::instance()->getDB();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        return $user;
    }
?>