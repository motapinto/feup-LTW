<?php
  $db = new PDO('sqlite:news.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $stmt = $db->prepare(
    'SELECT news.*, users.*, COUNT(comments.id) AS comments 
    FROM news JOIN
         users USING (username) LEFT JOIN 
         comments ON comments.news_id = news.id 
    GROUP BY news.id, users.username 
    ORDER BY published DESC'
  );
  $stmt->execute();
  $articles = $stmt->fetchAll();

  foreach( $articles as $article) { 
    echo '<h1>'.$article['title'].'</h1>';
    echo '<p>'.$article['introduction'].'</p>';
    echo '<p>'.$article['username'].'</p>';
    echo '<div>'.date('Y-m-d H:i:s', $article['published']).'</div>';
  }
?>