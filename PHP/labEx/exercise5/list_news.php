<?php
  $db = new PDO('sqlite:news.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $stmt = $db->prepare('SELECT * FROM news');
  $stmt->execute();
  $articles = $stmt->fetchAll();

  foreach( $articles as $article) { 
    echo '<h1>'.$article['title'].'</h1>';
    echo '<p>'.$article['introduction'].'</p>';
    echo '<h3>'.$article['username'].'</h3>';
    echo '<div>'.date('Y-m-d H:i:s', $article['published']).'</div>';
  }
?>