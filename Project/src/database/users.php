<?php
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/images.php');

    // Checks if the input user exists
    function checkUser($email, $password){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if ($user === false) 
            return -1;

        if(password_verify($password, $user['password']))
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
                            age = ?,
                            password = ?
                            WHERE id = ?');
        $stmt->execute(array($newEmail, $name, $age, password_hash($password, PASSWORD_DEFAULT), $id));
        
        $user = $stmt->fetch();
        print_r($user);
        return !$user?0:1;
    }

     // Deletes a user to the database
    function deleteUser($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('DELETE FROM User WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    // Adds a new user to the database
    function addUser($email, $password, $name, $age){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO User (
                email,
                password,
                name,
                age,
                image
            )
            VALUES (?, ?, ?, ?, ?);
        ');

        $options = ['cost' => 12];
        $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT), $name, $age, generate_random_token()));
        return $stmt->fetchAll();
    }
?>