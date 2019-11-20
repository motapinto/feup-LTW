<?php
    include_once('../includes/database.php');      // connects to the database

    //Returns all images for a property with id = id
    function getImagesByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT image_path
                              FROM Image 
                              WHERE property_id = ?'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all images for a property with id = id
    function getFirstImageOfProperty($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT image_path
                              FROM Image 
                              WHERE property_id = ?
                              GROUP BY property_id'
                            );
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Adds an image path to the database
    function addImage($property_id, $image_path){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Image (
                  property_id,
                  image_path
                )
                VALUES (?, ?);'
        );
        $stmt->execute(array($property_id, $image_path));

        return (!$stmt->fetch())?true:false;
    }
?>