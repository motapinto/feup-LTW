<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    //Returns all comments for a property with id = id
    function getCommentsByPropertyId($id){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Comment JOIN Property USING (username) WHERE news_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all comments with a username with username = username
    function getCommentsByUsername($username){
        global $db;

        $stmt = $db->prepare('SELECT * FROM Comment JOIN Property USING (username) WHERE news_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
?>