<?php
    include_once('../includes/database.php');      // connects to the database

    //Returns all comments for a property with id = id
    function getCommentsByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name, comment, date, Comment.rating
                              FROM Comment, User 
                              WHERE property_id = ? AND User.email = Comment.email;'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all comments with a email with email = email
    function getCommentsByEmail($email){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT name, comment, date, Comment.rating
                              FROM Comment, User 
                              WHERE Comment.email = ? AND User.email = Comment.email;'
                            );
        $stmt->execute(array($email));
        return $stmt->fetchAll();
    }

    function addComment($email, $property_id, $comment){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Comment (
                  email,
                  property_id,
                  comment
                )
                VALUES (?, ?, ?);'
        );
        $stmt->execute(array($email, $property_id, $comment));

        return (!$stmt->fetch())?true:false;
    }
?>