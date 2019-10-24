<?php

  include_once('database/connection.php');
  include_once('database/news.php');
  include_once('database/comments.php');

  $article = getNewsById($_GET['id']);
  $comments = getCommentsByNewsId($_GET['id']);

?>
