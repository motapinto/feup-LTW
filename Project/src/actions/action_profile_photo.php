<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/users.php');          // user functions

    if(!isset($_POST['photo']))
        header('Location: ../profile/profile.php');
    
    $user = userProfile($_SESSION['email']);        // get's current user
    $photoName = "u_" + $user['id'];

    $stmt = $db->prepare('INSERT INTO USER VALUES()');
    $stmt->execute(array($email));
    $comments = $stmt->fetch();

    // Generate filenames for original, small and medium files
    $originalFileName = "images/originals/$id.jpg";
    $smallFileName = "images/thumbs_small/$id.jpg";
    $mediumFileName = "images/thumbs_medium/$id.jpg";
?>
