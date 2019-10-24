<?php
  include_once('database/connection.php');
  include_once('database/news.php');
  include_once('templates/common/header.php');
  include_once('templates/common/footer.php');
  
  $id = $_GET['id'];

  drawHeader('News Item');
  $article = getNews($db, $id);

?>
  <h1><?=$article['title']?></h1>
  <p><?=$article['introduction']?></p>
<?php


  $comments = getComments($db, $id);

  foreach( $comments as $comment) { ?>
    <h4>By: <?=$comment['username']?></h4>
    <h5>Date: <?=$comment['published']?></h5>
    <p><?=$comment['text']?></p>
    <?php 
  }
  
?>

<form action="edit_news.php" method="GET">
      <input hidden id="id" name="id" value="<?=$id?>">
      <input type="submit" value="Edit News Item">
</form>

<?php

  drawFooter();
?>