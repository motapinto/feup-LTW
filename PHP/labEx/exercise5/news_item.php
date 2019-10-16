<?php

  $db = new PDO('sqlite:news.db');

  $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
  $stmt->execute(array($_GET['id']));
  $article = $stmt->fetch();

?>

  <h1>$article['title']</h1>
  <p>$article['introduction']</p>

<?php

  $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
  $stmt->execute(array($_GET['id']));
  $comments = $stmt->fetchAll();

  foreach( $comments as $comments) { ?>
  
    <?php }

?>
