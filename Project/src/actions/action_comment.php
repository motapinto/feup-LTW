<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if(!isset($_POST['email']) || !isset($_POST['property_id']) || !isset($_POST['comment']))
        header('Location: ../listings/listings_all.php');

    $email = $_POST['email'];
    $property_id = $_POST['property_id'];
    $comment = $_POST['comment'];

    if(!addComment($email, $property_id, $comment))
      $_SESSION['msg'] = 'Failled to post Comment';

    header("Location: ../listings/item.php?id=$property_id");
?>