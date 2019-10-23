<?php

  $db = new PDO('sqlite:news.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
  $stmt->execute(array($_GET['id']));
  $article = $stmt->fetch();


  $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
  $stmt->execute(array($_GET['id']));
  $comments = $stmt->fetchAll();

  foreach( $comments as $comments) { 
    echo '<h3>'.$comments['username'].'</h3>';
    echo '<p>'.$comments['text'].'</p>';
    echo '<p>'.date('Y-m-d H:i:s', $comments['published']).'</p>';
  }

?>
