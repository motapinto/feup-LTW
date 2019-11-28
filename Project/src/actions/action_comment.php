<?php
    include_once('../includes/session.php');        // starts the session
    include_once('../database/comments.php');       // comments functions

    if(!isset($_POST['property_id']) || !isset($_POST['comment']))
        header('Location: ../listings/listings_all.php');

    if(!addComment($_SESSION['id'], $_POST['property_id'], $_POST['comment']))
      $_SESSION['msg'] = 'Failled to post Comment';

    $property_id = $_POST['property_id'];

    header("Location: ../listings/item.php?id=$property_id");
?>