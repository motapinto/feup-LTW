<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if(!isset($_POST['property_id']) || !isset($_POST['comment']))
        header('Location: ../listings/listings_all.php');
	
	$property_id = $_POST['property_id'];
	$comment = $_POST['comment'];
	// Remove disallowed characters -XSS protection
	// $property_id = preg_replace ("/[^a-zA-Z\s]/", '', $property_id);
	// $comment = preg_replace ("/[^a-zA-Z\s]/", '', $comment);

    if(!addComment($_SESSION['id'], $property_id, $comment))
        $_SESSION['msg'] = 'Failled to post Comment';

    header("Location: ../listings/item.php?id=$property_id");
?>