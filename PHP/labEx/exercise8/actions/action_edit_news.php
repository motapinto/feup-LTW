<?php
    include_once(__DIR__ . '/../database/connection.php');
    include_once(__DIR__ . '/../database/news.php');

    $id = $_POST['id'];
    $title = $_POST['title'];
    $intro = $_POST['intro'];
    $text = $_POST['text'];

    updateNews($db, $id, $title, $intro, $text);

    header('Location: ../news_item.php?id=' . $id);

?>