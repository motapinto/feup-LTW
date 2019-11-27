<?php
    include_once('../includes/database.php');      // connects to the database

    // Checks if the input user exists
    function checkUser($email, $password){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if (!$user) 
            return -1;
        
        if(strtoupper(sha1($password)) === strtoupper($user['password']))
            return $user['id'];

        else
            return -2;
    }

    // Returns the user with the received email
    function userProfile($id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM User WHERE id = ?');
        $stmt->execute(array($id));
        $user = $stmt->fetch();

        return $user;
    }

    // Checks if the input user exists
    function changeUser($id, $newEmail, $name, $age, $password){
        $db = Database::instance()->db();

        $user = userProfile($id);
        if($user['email'] !== $newEmail) {
            $stmt = $db->prepare('SELECT email FROM User WHERE email = ?');
            $stmt->execute(array($newEmail));
            $res = $stmt->fetch();
            if($res !== false)
                return 2;
            }
            
        $stmt = $db->prepare('UPDATE User
                            SET email = ?,
                            name = ?,
                            age = ?
                            WHERE id = ?');
        $stmt->execute(array($newEmail, $name, $age, $id));
        
        $user = $stmt->fetch();
        return !$user?0:1;
    }

    // Adds a new user to the database
    function addUser($email, $password, $name, $age){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO User (
                email,
                password,
                name,
                age
            )
            VALUES (?, ?, ?, ?);
        ');
        $stmt->execute(array($email, sha1($password), $name, $age));
        $user = $stmt->fetch();
        return !$user?true:false;
    }

    // Returns the user with the received email
    function userCommentsAll($email, $comments) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Comment WHERE email = ?');
        $stmt->execute(array($email));
        $comments = $stmt->fetch();

        return $comments;
    }
?>