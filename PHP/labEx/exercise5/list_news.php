<?php
  $db = new PDO('sqlite:news.db');

  $stmt = $db->prepare('SELECT * FROM news');
  $stmt->execute();
  $articles = $stmt->fetchAll();

  foreach( $articles as $article) { ?>
    <h1><?=$article['title']?></h1>
    <p><?=$article['introduction']?></p>
    <?php }
?>