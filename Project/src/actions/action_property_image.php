<?php
    error_reporting(E_ERROR | E_PARSE);

    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/images.php');      // properties functions
    include_once('../templates/tpl_common.php');   // encodeForAJAX

    $ret = array('response' => -1);

    if(!isset($_SESSION['id'])){
        $ret['response'] = -2;
        encodeForAJAX($ret);
        exit;
    }
    
    if(!isset($_POST['property_id'])){
        $ret['response'] = -3;
        encodeForAJAX($ret);
        exit;
    }

    $property_id = $_POST['property_id'];
    htmlentities($property_id, ENT_QUOTES, 'UTF-8');

    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        htmlentities($name, ENT_QUOTES, 'UTF-8');
        $ret['response'] = deleteImageName($property_id, $name);
        deleteImage($name, 'PROPERTY');
        encodeForAJAX($ret);
        exit;
    }

    if(!isset($_FILES['image'])){
        $ret['response'] = -3;
        encodeForAJAX($ret);
        exit;
    }
    
    $property_id = $_POST['property_id'];
    // Crete an image representation of the original image
    $original = imagecreatefrompng($_FILES['image']['tmp_name']);
    if($original === false){
        $original = imagecreatefromjpeg($_FILES['image']['tmp_name']);
        if($original === false){
            $original = imagecreatefrombmp($_FILES['image']['tmp_name']);
            if($original === false){
                $original = imagecreatefromgd2($_FILES['image']['tmp_name']);
                if($original === false){
                    $original = imagecreatefromgd2part($_FILES['image']['tmp_name']);
                    if($original === false){
                        $original = imagecreatefromgd($_FILES['image']['tmp_name']);
                        if($original === false){
                            $original = imagecreatefromgif($_FILES['image']['tmp_name']);
                            if($original === false){
                                $original = imagecreatefromwbmp($_FILES['image']['tmp_name']);
                                if($original === false){
                                    $original = imagecreatefromxbm($_FILES['image']['tmp_name']);
                                    if($original === false){
                                        $original = imagecreatefromwebp($_FILES['image']['tmp_name']);
                                        if($original === false)
                                            $original = imagecreatefromxpm($_FILES['image']['tmp_name']); 

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if($original === false){
        $ret['response'] = -1;
        encodeForAJAX($ret);
        return;
    }

    $name = generate_random_token();
    addImage($property_id, $name);

    // Generate filenames for original, small and medium files
    $originalFileName = "../../assets/images/properties/o_$name.png";
    $smallFileName = "../../assets/images/properties/s_$name.png";
    $mediumFileName = "../../assets/images/properties/m_$name.png";

    // Move the uploaded file to its final destination
    move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

    $width = imagesx($original);     // width of the original image
    $height = imagesy($original);    // height of the original image
    $square = min($width, $height);  // size length of the maximum square

    // Create and save a small square thumbnail
    $small = imagecreatetruecolor(200, 200);
    imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
    imagepng($small, $smallFileName);

    // Calculate width and height of medium sized image (max width: 400)
    $mediumwidth = $width;
    $mediumheight = $height;
    if ($mediumwidth > 400) {
        $mediumwidth = 400;
        $mediumheight = $mediumheight * ( $mediumwidth / $width );
    }

    // Create and save a medium image
    $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
    imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
    imagepng($medium, $mediumFileName);

    $ret['response'] = 0;
    $ret['name'] = $name;
    encodeForAJAX($ret);
?>