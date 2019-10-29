<?php

  $path = dirname(__FILE__);
  include_once('database/connection.php'); 
  include_once('database/news.php');   
  include_once('database/comments.php');

  if (!isset($_GET['id']))
    die("No id!");

  include_once('templates/common/header.php');

  $article = getNewsById($_GET['id']);
  include_once('templates/news/news_item.php');

  $comments = getCommentsByNewsId($_GET['id']);
  include_once('templates/comments/list_comments.php');
  
  include_once('templates/common/footer.php');

?>
