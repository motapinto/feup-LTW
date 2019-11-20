<?php

function draw_comment($comment) { ?>
  <article class='comment'>
    <!-- <img src=<?= $comment['id'] ?> alt="Image of <?= $comment['name'] ?>"> -->
    <h3><?= $comment['name'] ?></h3>
    <h6><?= $comment['date'] ?>  Rating:<?= $comment['rating'] ?></h6> <!-- missing star image -->
    <p><?= $comment['comment'] ?></p>
  </article>
<?php }


function draw_allComments($comments) { ?>
  <section id="comments">
    <h2>Comments</h2>
    <?php foreach ($comments as $comment) {
        draw_comment($comment);
      } ?>
  </section>
<?php }

?>