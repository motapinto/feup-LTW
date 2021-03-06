<?php
    include_once('../includes/database.php');      // connects to the database

    define('ORIGINAL', 0, true);
    define('MEDIUM', 1, true);
    define('SMALL', 2, true);
    define('USER', 0, true);
    define('PROPERTY', 1, true);
    
    // Generates a random token to be used to store an image
    function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
    }

    // Deletes image with name = name
    function deleteImage($name, $option){
        switch ($option) {
            case 'USER':
                if(file_exists("../../assets/images/users/o_$name.png")){
                    unlink("../../assets/images/users/o_$name.png");
                    unlink("../../assets/images/users/m_$name.png");
                    unlink("../../assets/images/users/s_$name.png");
                }
                break;
            case 'PROPERTY':
                if(file_exists("../../assets/images/properties/o_$name.png")){
                    unlink("../../assets/images/properties/o_$name.png");
                    unlink("../../assets/images/properties/m_$name.png");
                    unlink("../../assets/images/properties/s_$name.png");
                }
                break;
            
            default:
                break;
        }
    }

    // Deletes image from property
    function deleteImageName($property_id, $name) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('DELETE FROM Image 
                              WHERE property_id = ?
                              AND name LIKE ?'
                            );
        $stmt->execute(array($property_id, $name));
        return !$stmt->fetch()?0:1;
    }

    //Returns all images for a property with id = id
    function getImagesByPropertyId($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT *
                              FROM Image 
                              WHERE property_id = ?'
                            );
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    //Returns all images for a property with id = id
    function getFirstImageOfProperty($id){
        $db = Database::instance()->db();

        $stmt = $db->prepare('SELECT * FROM Image where property_id = ? LIMIT 1');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    // Adds an image path to the database
    function addImage($property_id, $name){
        $db = Database::instance()->db();

        $stmt = $db->prepare('INSERT INTO Image (property_id, name)
                VALUES (?, ?)');
        $stmt->execute(array($property_id, $name));

        return $db->lastInsertId();
    }

    function getImagePathsByPropertyId($id, $option='ORIGINAL'){
        $images = getImagesByPropertyId($id);
        $imagePaths= array();

        foreach ($images as $image) {
            $name = $image['name'];
            if(file_exists("../../assets/images/properties/o_$name.png"))
                switch ($option) {
                    case 'ORIGINAL':
                        array_push($imagePaths, "../../assets/images/properties/o_$name.png");
                        break;
                    
                    case 'MEDIUM':
                        array_push($imagePaths, "../../assets/images/properties/m_$name.png");
                        break;
                    
                    case 'SMALL':
                        array_push($imagePaths, "../../assets/images/properties/s_$name.png");
                        break;
                    
                    default:
                        break;
                }
            else array_push($imagePaths, "../../assets/images/noImgProp.png");
        }

        return $imagePaths;
    }

    function getFirstImagePathOfProperty($id, $option = 'ORIGINAL'){
        $name = getFirstImageOfProperty($id)['name'];
        if(file_exists("../../assets/images/properties/o_$name.png"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/properties/o_$name.png";
                
                case 'MEDIUM':
                    return "../../assets/images/properties/m_$name.png";
                
                case 'SMALL':
                    return "../../assets/images/properties/s_$name.png";
                
                default:
                    break;
            }
            
        return "../../assets/images/noImgProp.png";
    }

    function getUserImagePath($id, $option = 'ORIGINAL'){
        $image = userProfile($id)['image'];
        if(file_exists("../../assets/images/users/o_$image.png"))
            switch ($option) {
                case 'ORIGINAL':
                    return "../../assets/images/users/o_$image.png";
                    break;
                
                case 'MEDIUM':
                    return "../../assets/images/users/m_$image.png";
                    break;
                
                case 'SMALL':
                    return "../../assets/images/users/s_$image.png";
                    break;
                
                default:
                    break;
            }
            
        return "../../assets/images/noImage.jpg";
    }
?>