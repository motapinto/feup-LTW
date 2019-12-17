<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        // alert('ERROR: Request does not appear to be legitimate');
        die(header('Location: ../listings/listings_all.php'));
    }

    if(!isset($_POST['property_id']) || !isset($_POST['comment']) ||
        !preg_match('/^[0-9]+$/', $_POST['property_id'], $output_array) ||
        !preg_match('/^[1-5]$/', $_POST['rating'], $output_array) ){
            
        die(header('Location: ../listings/listings_all.php'));
    }
	
	$property_id = $_POST['property_id'];
    $comment = htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8');
    $rating = $_POST['rating'];     

    if(!addComment($_SESSION['id'], $property_id, $comment, $rating))
        $_SESSION['msg'] = 'Failled to post Comment';

    header("Location: ../listings/item.php?id=$property_id");
?>