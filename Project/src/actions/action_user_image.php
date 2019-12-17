<?php
    include_once('../includes/session.php');       // starts the session
    include_once('../includes/database.php');      // connects to the database
    include_once('../database/listings.php');      // properties functions
    include_once('../database/images.php');
    include_once('../database/users.php');

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        // alert('ERROR: Request does not appear to be legitimate');
        die(header('Location: ../listings/listings_all.php'));
    }
    
    if(!isset($_SESSION['id']))
        die(header('Location: ../listings/listings_all.php'));                                 // main webpage

    if(!isset($_FILES))
        die(header('Location: ../profile/profile.php'));                                 // main webpage

    $name = userProfile($_SESSION['id'])['image'];

    deleteImage($name, 'USER');

    // Generate filenames for original, small and medium files
    $originalFileName = "../../assets/images/users/o_$name.png";
    $smallFileName = "../../assets/images/users/s_$name.png";
    $mediumFileName = "../../assets/images/users/m_$name.png";

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
        $_SESSION['msg'] = 'File is not an image, please choose a valid image';
        die();
    }

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
    

    header('Location: ../profile/profile.php');
?>