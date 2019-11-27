<?php
    include_once('../includes/database.php');      // connects to the database

    define('ORIGINAL', 0, true);
    define('MEDIUM', 1, true);
    define('SMALL', 2, true);

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

    function getImagePathsByPropertyId($id, $option='ORIGINAL'){
        $images = getImagesByPropertyId($id);
        $imagePaths= array();

        foreach ($images as $image) {
            $imageId = $image['id'];
            if(file_exists("../../assets/images/originals/p_$imageId.jpg")){
                switch ($option) {
                    case 'ORIGINAL':
                        array_push($imagePaths, "../../assets/images/originals/p_$imageId.jpg");
                        break;
                    
                    case 'MEDIUM':
                        array_push($imagePaths, "../../assets/images/thumbs_medium/p_$imageId.jpg");
                        break;
                    
                    case 'SMALL':
                        array_push($imagePaths, "../../assets/images/thumbs_small/p_$imageId.jpg");
                        break;
                    
                    default:
                        break;
                }
            }
            else if(file_exists("../../assets/images/originals/p_$imageId.png"))
                switch ($option) {
                    case 'ORIGINAL':
                        array_push($imagePaths, "../../assets/images/originals/p_$imageId.png");
                        break;
                    
                    case 'MEDIUM':
                        array_push($imagePaths, "../../assets/images/thumbs_medium/p_$imageId.png");
                        break;
                    
                    case 'SMALL':
                        array_push($imagePaths, "../../assets/images/thumbs_small/p_$imageId.png");
                        break;
                    
                    default:
                        break;
                }
        }

        return $imagePaths;
    }

    function getFirstImagePathOfProperty($id, $option = 'ORIGINAL'){
        if(file_exists("../../assets/images/originals/p_$id.jpg"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/originals/p_$id.jpg";
                    break;
                
                case 'MEDIUM':
                    return "../../assets/images/thumbs_medium/p_$id.jpg";
                    break;
                
                case 'SMALL':
                    return "../../assets/images/thumbs_small/p_$id.jpg";
                    break;
                
                default:
                    break;
            }
        else if(file_exists("../../assets/images/originals/p_$id.png"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/originals/p_$id.png";
                    break;
                
                case 'MEDIUM':
                    return "../../assets/images/thumbs_medium/p_$id.png";
                    break;
                
                case 'SMALL':
                    return "../../assets/images/thumbs_small/p_$id.png";
                    break;
                
                default:
                    break;
            }
            
        return;
    }

    function getUserImagePath($id, $option = 'ORIGINAL'){
        if(file_exists("../../assets/images/originals/u_$id.jpg"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/originals/u_$id.jpg";
                    break;
                
                case 'MEDIUM':
                    return "../../assets/images/thumbs_medium/u_$id.jpg";
                    break;
                
                case 'SMALL':
                    return "../../assets/images/thumbs_small/u_$id.jpg";
                    break;
                
                default:
                    break;
            }
        else if(file_exists("../../assets/images/originals/u_$id.png"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/original/u_$id.png";
                    break;
                
                case 'MEDIUM':
                    return "../../assets/images/thumbs_medium/u_$id.png";
                    break;
                
                case 'SMALL':
                    return "../../assets/images/thumbs_small/u_$id.png";
                    break;
                
                default:
                    break;
            }
            
        return "../../assets/images/noImage.jpg";
    }
?>