<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if(!isset($_POST['property_id']) || !isset($_POST['comment']))
        header('Location: ../listings/listings_all.php');
	
	$property_id = $_POST['property_id'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating']; 
    
	htmlentities($property_id, ENT_QUOTES, 'UTF-8');
    htmlentities($comment, ENT_QUOTES, 'UTF-8');

    if(!addComment($_SESSION['id'], $property_id, $comment, $rating))
        $_SESSION['msg'] = 'Failled to post Comment';

    header("Location: ../listings/item.php?id=$property_id");
?>