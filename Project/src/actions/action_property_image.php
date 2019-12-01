<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/images.php');      // properties functions
    
    if(!isset($_SESSION['id']))
        header('Location: ../listings/listings_all.php');                                 // main webpage
    
    $property_id = $_POST['property_id'];
    $id = addImage($property_id);
    $name = $_FILES['image']['name'];

    htmlentities($property_id, ENT_QUOTES, 'UTF-8');

    if(strpos($name, '.jpg') !== false || strpos($name, '.jpeg') !== false){ //Contains .jpg

        // Generate filenames for original, small and medium files
        $originalFileName = "../../assets/images/originals/p_$id.jpg";
        $smallFileName = "../../assets/images/thumbs_small/p_$id.jpg";
        $mediumFileName = "../../assets/images/thumbs_medium/p_$id.jpg";

        // Move the uploaded file to its final destination
        move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

        // Crete an image representation of the original image
        $original = imagecreatefromjpeg($originalFileName);

        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image
        $square = min($width, $height);  // size length of the maximum square

        // Create and save a small square thumbnail
        $small = imagecreatetruecolor(200, 200);
        imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
        imagejpeg($small, $smallFileName);

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
        imagejpeg($medium, $mediumFileName);
    }
    else if(strpos($name, '.png') !== false){ //Contains .png

        // Generate filenames for original, small and medium files
        $originalFileName = "../../assets/images/originals/p_$id.png";
        $smallFileName = "../../assets/images/thumbs_small/p_$id.png";
        $mediumFileName = "../../assets/images/thumbs_medium/p_$id.png";

        // Move the uploaded file to its final destination
        move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

        // Crete an image representation of the original image
        $original = imagecreatefrompng($originalFileName);

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
    }
    else
        $_SESSION['msg'] = "Invalid image type, please use a .jpg/.jpeg or .png image.";

    
    header("Location: ../properties/add_property_image.php?id=$property_id");
?>