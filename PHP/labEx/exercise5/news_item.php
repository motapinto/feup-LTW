<?php

  $db = new PDO('sqlite:news.db');

  $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
  $stmt->execute(array($_GET['id']));
  $article = $stmt->fetch();


  $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
  $stmt->execute(array($_GET['id']));
  $comments = $stmt->fetchAll();

  foreach( $comments as $comments) { 
    echo '<h1>'.$comments['news_id'].'</h1>';
    echo '<p>'.$comments['username'].'</p>';
    echo '<p>'.$comments['published'].'</p>';
  }

?>
