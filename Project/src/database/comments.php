<?php
    include_once('../includes/database.php');      // connects to the database

    //Returns all comments for a property with id = id
    function getCommentsByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Comment WHERE property_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all comments with a username with username = username
    function getCommentsByUsername($username){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Comment WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }
?>