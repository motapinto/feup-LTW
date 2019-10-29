<?php

  $db = new PDO('sqlite:news.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  if (!isset($_GET['id']))
    die("No id!");

  $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
  $stmt->execute(array($_GET['id']));

  while( $article = $stmt->fetch()) { 
    echo '<h1>'.$article['title'].'</h3>';
    echo '<h3>'.$article['introduction'].'</h3>';
    echo '<p>'.$article['fulltext'].'</p>';
  }

  $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
  $stmt->execute(array($_GET['id']));
  $comments = $stmt->fetchAll();

  foreach( $comments as $comments) { 
    echo '<h3>'.$comments['username'].'</h3>';
    echo '<p>'.$comments['text'].'</p>';
    echo '<p>'.date('d/m/Y H:i:s', $comments['published']).'</p>';
  }

?>
