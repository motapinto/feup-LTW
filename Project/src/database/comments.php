<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    //Returns all comments for a property with id = id
    function getCommentsByPropertyId($id){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Comment WHERE property_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all comments with a username with username = username
    function getCommentsByUsername($username){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Comment WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }
?>