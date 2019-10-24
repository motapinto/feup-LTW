<?php
include_once(__DIR__ . '/../database/connection.php');
    include_once(__DIR__ . '/../database/news.php');

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if(!checkPass($db, $user, $pass))
        die(header('Location: ../list_news.php'));

    $_SESSION['username'] = $user;
    session_start();

    header('Location: ../list_news.php');
?>
