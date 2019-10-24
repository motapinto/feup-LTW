<?php
  include_once('database/connection.php');
  include_once('database/news.php');

  function drawNews($db) {
    $articles = getAllNews($db);

    foreach( $articles as $article) { ?>
      <h1><a href="news_item.php?id=<?=$article['id']?>"><?=$article['title']?></a></h1>
      <p><?=$article['introduction']?></p>
      <?php }
  }
?>