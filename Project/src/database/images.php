<?php
    include_once('../includes/database.php');      // connects to the database

    //Returns all images for a property with id = id
    function getImagesByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT id
                              FROM Image 
                              WHERE property_id = ?'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all images for a property with id = id
    function getFirstImageOfProperty($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT id
                              FROM Image 
                              WHERE property_id = ?
                              GROUP BY id'
                            );
        $stmt->execute(array($id));
        return $stmt->fetch()['id'];
    }

    // Adds an image path to the database
    function addImage($property_id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Image (property_id)
                VALUES (?)');
        $stmt->execute(array($property_id));

        return $db->lastInsertId();
    }

    function getImagePathsByPropertyId($id, $option=0){
        $images = getImagesByPropertyId($id);
        $imagePaths= array();

        foreach ($images as $image) {
            if(file_exists("../../assets/images/original/p_$id.jpg")){
                switch ($option) {
                    case 0:
                        array_push($imagePaths, "../../assets/images/original/p_$id.jpg");
                        break;
                    
                    case 1:
                        array_push($imagePaths, "../../assets/images/thumbs_medium/p_$id.jpg");
                        break;
                    
                    case 2:
                        array_push($imagePaths, "../../assets/images/thumbs_small/p_$id.jpg");
                        break;
                    
                    default:
                        break;
                }
            }
            else if(file_exists("../../assets/images/thumbs_medium/p_$id.png"))
                switch ($option) {
                    case 0:
                        array_push($imagePaths, "../../assets/images/original/p_$id.png");
                        break;
                    
                    case 1:
                        array_push($imagePaths, "../../assets/images/thumbs_medium/p_$id.png");
                        break;
                    
                    case 2:
                        array_push($imagePaths, "../../assets/images/thumbs_small/p_$id.png");
                        break;
                    
                    default:
                        break;
                }
        }

        return $imagePaths;
    }

    function getFirstImagePathOfProperty($id, $option=0){
        if(file_exists("../../assets/images/thumbs_medium/p_$id.jpg"))
            switch ($option) {
                case 0:
                    return "../../assets/images/original/p_$id.jpg";
                    break;
                
                case 1:
                    return "../../assets/images/thumbs_medium/p_$id.jpg";
                    break;
                
                case 2:
                    return "../../assets/images/thumbs_small/p_$id.jpg";
                    break;
                
                default:
                    break;
            }
        else if(file_exists("../../assets/images/original/p_$id.png"))
            switch ($option) {
                case 0:
                    return "../../assets/images/original/p_$id.png";
                    break;
                
                case 1:
                    return "../../assets/images/thumbs_medium/p_$id.png";
                    break;
                
                case 2:
                    return "../../assets/images/thumbs_small/p_$id.png";
                    break;
                
                default:
                    break;
            }
            
        return "../../assets/images/noImage.jpg";
    }

    function getUserImagePath($id, $option=0){
        if(file_exists("../../assets/images/thumbs_medium/u_$id.jpg"))
            switch ($option) {
                case 0:
                    return "../../assets/images/original/u_$id.jpg";
                    break;
                
                case 1:
                    return "../../assets/images/thumbs_medium/u_$id.jpg";
                    break;
                
                case 2:
                    return "../../assets/images/thumbs_small/u_$id.jpg";
                    break;
                
                default:
                    break;
            }
        else if(file_exists("../../assets/images/original/u_$id.png"))
            switch ($option) {
                case 0:
                    return "../../assets/images/original/u_$id.png";
                    break;
                
                case 1:
                    return "../../assets/images/thumbs_medium/u_$id.png";
                    break;
                
                case 2:
                    return "../../assets/images/thumbs_small/u_$id.png";
                    break;
                
                default:
                    break;
            }
            
        return "../../assets/images/noImage.jpg";
    }
?>