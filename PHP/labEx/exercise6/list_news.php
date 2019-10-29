<?php
  include_once('database/connection.php'); 
  include_once('database/news.php');   
  
  $articles = getAllNews();                

  foreach( $articles as $article) { 
    echo '<h1>'.$article['title'].'</h1>';
    echo '<p>'.$article['introduction'].'</p>';
    echo '<h3>'.$article['username'].'</h3>';
    echo '<div>'.date('Y-m-d H:i:s', $article['published']).'</div>';
  }
?>