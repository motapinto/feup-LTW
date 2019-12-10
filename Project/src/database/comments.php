<?php
    include_once('../includes/database.php');      // connects to the database

    //Returns all comments for a property with id = id
    function getCommentsByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT comment, date, Comment.rating AS rating, name, user_id
                              FROM Comment, User
                              WHERE property_id = ? AND User.id = user_id'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all comments done by other users to user properties or from the user itself
    function getAllUserRelatedComments($owner) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT* FROM (
                SELECT C.property_id, C.user_id as commentator,
                P.user_id as owner, C.comment, C.rating, C.date 
                FROM Comment C JOIN Property P ON P.id = C.property_id
                WHERE owner = ?
                
                UNION 

                SELECT  C.property_id, C.user_id as commentator, 
                C.user_id, C.comment, C.rating, C.date FROM Comment C 
                WHERE user_id = ?
            ) ORDER BY date DESC;'
        );
        $stmt->execute(array($owner));
        return $stmt->fetchAll();
    }

    //Adds a comment to the database
    function addComment($user_id, $property_id, $comment){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Comment (
                  user_id,
                  property_id,
                  comment
                )
                VALUES (?, ?, ?);'
        );
        $stmt->execute(array($user_id, $property_id, $comment));

        return (!$stmt->fetch())?true:false;
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