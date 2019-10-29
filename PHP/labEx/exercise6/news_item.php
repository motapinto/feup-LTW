<?php

  include_once('database/connection.php');
  include_once('database/news.php');
  include_once('database/comments.php');

  if (!isset($_GET['id']))
    die("No id!");

  $article = getNewsById($_GET['id']);
  while( $article = $stmt->fetch()) { 
    echo '<h1>'.$article['title'].'</h3>';
    echo '<h3>'.$article['introduction'].'</h3>';
    echo '<p>'.$article['fulltext'].'</p>';
  }

  $comments = getCommentsByNewsId($_GET['id']);
  foreach( $comments as $comments) { 
    echo '<h3>'.$comments['username'].'</h3>';
    echo '<p>'.$comments['text'].'</p>';
    echo '<p>'.date('d/m/Y H:i:s', $comments['published']).'</p>';
  }

?>
