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
    function getCommentsByUserId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT comment, date, rating
                              FROM Comment 
                              WHERE user_id = ?'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Adds a comment to the database
    function addComment($id, $property_id, $comment){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Comment (
                  id,
                  property_id,
                  comment
                )
                VALUES (?, ?, ?);'
        );
        $stmt->execute(array($id, $property_id, $comment));

        return (!$stmt->fetch())?true:false;
    }

    //Returns number of comments the user with email = email has done
    function numberCommentsByEmail($email){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT COUNT(*) as count
                              FROM Comment 
                              WHERE email = ?'
                            );
        $stmt->execute(array($email));
        return $stmt->fetch()['count'];
    }

    //Returns number of comments the property has
    function numberCommentsByProperty($property_id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT COUNT(*) as count
                              FROM Comment 
                              WHERE property_id = ?'
                            );
        $stmt->execute(array($property_id));
        return $stmt->fetch()['count'];
    }
?>