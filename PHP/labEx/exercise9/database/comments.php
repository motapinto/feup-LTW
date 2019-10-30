<?php
    session_start(); 
    include_once(__DIR__.'/connection.php');

    //Returns all comments for a news with id = id
    function getCommentsByNewsId($id){
        global $db;

        $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
?>